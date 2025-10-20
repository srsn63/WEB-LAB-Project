<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Batch;
use App\Services\AuditLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AdminStudentController extends Controller
{
    /**
     * Display students management page
     */
    public function index(): View
    {
        $students = Student::orderBy('batch', 'desc')
            ->orderBy('student_id', 'asc')
            ->paginate(20);
        $batches = Batch::sorted('desc')->get();
        
        return view('admin.students.index', compact('students', 'batches'));
    }

    /**
     * Store a newly created student
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'batch' => ['required', 'string', 'regex:/^2k(20|21|22|23|24)$/'],
            'email' => ['required', 'email', 'unique:students,email', 'regex:/@stud\.kuet\.ac\.bd$/'],
            'password' => ['required', 'string', 'min:6'],
            'phone' => ['nullable', 'string', 'max:20'],
            'profile_picture' => ['nullable', 'url', 'max:500'],
            'cgpa' => ['nullable', 'numeric', 'min:0', 'max:4'],
            'current_semester' => ['nullable', 'string', 'max:50'],
            'is_active' => ['nullable', 'boolean'],
        ], [
            'email.regex' => 'Email must end with @stud.kuet.ac.bd',
            'batch.regex' => 'Batch must be in format 2k20, 2k21, 2k22, 2k23, or 2k24',
            'profile_picture.url' => 'Profile picture must be a valid URL',
        ]);

        // Generate student ID
        $nextSerial = Student::getNextSerialForBatch($data['batch']);
        
        if ($nextSerial > 121) {
            return back()->withInput()->withErrors(['batch' => "Batch {$data['batch']} is full (maximum 121 students)."])->with('error', 'Cannot add more students to this batch.');
        }

        $studentId = Student::generateStudentId($data['batch'], $nextSerial);

        // Create student
        $student = Student::create([
            'student_id' => $studentId,
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'batch' => $data['batch'],
            'phone' => $data['phone'] ?? null,
            'profile_picture' => $data['profile_picture'] ?? null,
            'cgpa' => $data['cgpa'] ?? 0.00,
            'current_semester' => $data['current_semester'] ?? null,
            'is_active' => $request->has('is_active'),
        ]);

        AuditLogger::log($request, 'created', 'Student', $student->id, $student->name . ' (' . $student->student_id . ')', null);

        return redirect()
            ->route('admin.students.index')
            ->with('status', "Student {$student->name} (ID: {$studentId}) created successfully. Default password: {$data['password']}");
    }

    /**
     * Show edit form for a student
     */
    public function edit(Student $student): View
    {
        $batches = Batch::sorted('desc')->get();
        return view('admin.students.edit', compact('student', 'batches'));
    }

    /**
     * Update the specified student
     */
    public function update(Request $request, Student $student): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:students,email,' . $student->id, 'regex:/@stud\.kuet\.ac\.bd$/'],
            'password' => ['nullable', 'string', 'min:6'],
            'phone' => ['nullable', 'string', 'max:20'],
            'profile_picture' => ['nullable', 'url', 'max:500'],
            'cgpa' => ['nullable', 'numeric', 'min:0', 'max:4'],
            'current_semester' => ['nullable', 'string', 'max:50'],
            'is_active' => ['nullable', 'boolean'],
        ], [
            'email.regex' => 'Email must end with @stud.kuet.ac.bd',
            'profile_picture.url' => 'Profile picture must be a valid URL',
        ]);

        $updateData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'profile_picture' => $data['profile_picture'] ?? null,
            'cgpa' => $data['cgpa'] ?? 0.00,
            'current_semester' => $data['current_semester'] ?? null,
            'is_active' => $request->has('is_active'),
        ];

        // Only update password if provided
        if (!empty($data['password'])) {
            $updateData['password'] = Hash::make($data['password']);
        }

        $before = $student->getOriginal();
        $student->update($updateData);
        $after = $student->fresh()->toArray();

        // Build diff of changed fields
        $changed = [];
        foreach ($updateData as $k => $v) {
            $prev = $before[$k] ?? null;
            $next = $after[$k] ?? null;
            if ($k === 'password') {
                if (!empty($v)) {
                    $changed[$k] = ['before' => '******', 'after' => '******'];
                }
                continue;
            }
            if ($prev != $next) {
                $changed[$k] = ['before' => $prev, 'after' => $next];
            }
        }

        AuditLogger::log($request, 'updated', 'Student', $student->id, $student->name . ' (' . $student->student_id . ')', $changed);

        return redirect()
            ->route('admin.students.index')
            ->with('status', 'Student updated successfully.');
    }

    /**
     * Remove the specified student
     */
    public function destroy(Student $student): RedirectResponse
    {
        $studentName = $student->name;
        $studentId = $student->student_id;
        
        AuditLogger::log(request(), 'deleted', 'Student', $student->id, $studentName . ' (' . $studentId . ')', null);
        
        $student->delete();

        return redirect()
            ->route('admin.students.index')
            ->with('status', "Student {$studentName} (ID: {$studentId}) has been deleted.");
    }
}
