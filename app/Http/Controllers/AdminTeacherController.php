<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class AdminTeacherController extends Controller
{
    /**
     * Persist a freshly created teacher profile from the admin panel.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'is_head' => ['nullable', 'boolean'],
            'designation' => ['required', 'string', 'in:Professor,Associate Professor,Assistant Professor,Lecturer'],
            'availability_status' => ['required', 'string', 'in:Available,On Leave'],
            'email' => ['required', 'email', 'max:255', 'unique:teachers', 'regex:/^[\w\.\-]+@teachers\.gmail\.com$/'],
            'password' => ['required', 'string', 'min:6'],
            'phone' => ['nullable', 'string', 'max:255'],
            'office_room' => ['nullable', 'string', 'max:255'],
            'website_url' => ['nullable', 'url'],
            'profile_image' => ['nullable', 'url'],
            'short_bio' => ['nullable', 'string'],
            'research_interests' => ['nullable', 'string'],
            'education' => ['nullable', 'string'],
            'honors' => ['nullable', 'string'],
            'courses' => ['nullable', 'string'],
            'publications' => ['nullable', 'string'],
        ], [
            'email.regex' => 'Email must end with @teachers.gmail.com',
        ]);

        // Ensure only a Professor can be assigned as Head
        $isHead = filter_var($request->input('is_head'), FILTER_VALIDATE_BOOLEAN);
        if ($isHead && $data['designation'] !== 'Professor') {
            return redirect()->back()->withInput()->withErrors(['is_head' => 'Only a Professor can be assigned as Head of Department.']);
        }

        // Ensure only Available teachers can be assigned as Head
        if ($isHead && $data['availability_status'] === 'On Leave') {
            return redirect()->back()->withInput()->withErrors(['is_head' => 'Teachers on leave cannot be appointed as Head of Department.']);
        }

        // If marking as head, unset existing head(s)
        if ($isHead) {
            Teacher::where('is_head', true)->update(['is_head' => false]);
        }

        Teacher::create([
            'name' => $data['name'],
            'is_head' => $isHead,
            'designation' => $data['designation'],
            'department' => 'Department of Computer Science & Engineering',
            'availability_status' => $data['availability_status'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'] ?? null,
            'office_room' => $data['office_room'] ?? null,
            'website_url' => $data['website_url'] ?? null,
            'profile_image' => $data['profile_image'] ?? null,
            'short_bio' => $data['short_bio'] ?? null,
            'research_interests' => $data['research_interests'] ?? null,
            'education' => $this->splitToArray($data['education'] ?? null),
            'honors' => $this->splitToArray($data['honors'] ?? null),
            'courses' => $this->splitToArray($data['courses'] ?? null),
            'publications' => $data['publications'] ?? null,
        ]);

        return redirect()
            ->route('admin.dashboard')
            ->with('status', 'Teacher profile created successfully. Email: ' . $data['email'] . ' | Password: ' . $data['password']);
    }

    /**
     * Show the form for editing a teacher profile.
     */
    public function edit(Teacher $teacher): View
    {
        return view('admin.teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified teacher profile.
     */
    public function update(Request $request, Teacher $teacher): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'is_head' => ['nullable', 'boolean'],
            'designation' => ['required', 'string', 'in:Professor,Associate Professor,Assistant Professor,Lecturer'],
            'availability_status' => ['required', 'string', 'in:Available,On Leave'],
            'email' => ['required', 'email', 'max:255', 'unique:teachers,email,' . $teacher->id, 'regex:/^[\w\.\-]+@teachers\.gmail\.com$/'],
            'password' => ['nullable', 'string', 'min:6'],
            'phone' => ['nullable', 'string', 'max:255'],
            'office_room' => ['nullable', 'string', 'max:255'],
            'website_url' => ['nullable', 'url'],
            'profile_image' => ['nullable', 'url'],
            'short_bio' => ['nullable', 'string'],
            'research_interests' => ['nullable', 'string'],
            'education' => ['nullable', 'string'],
            'honors' => ['nullable', 'string'],
            'courses' => ['nullable', 'string'],
            'publications' => ['nullable', 'string'],
        ], [
            'email.regex' => 'Email must end with @teachers.gmail.com',
        ]);

        $isHead = filter_var($request->input('is_head'), FILTER_VALIDATE_BOOLEAN);
        if ($isHead && $data['designation'] !== 'Professor') {
            return redirect()->back()->withInput()->withErrors(['is_head' => 'Only a Professor can be assigned as Head of Department.']);
        }

        // Ensure only Available teachers can be assigned as Head
        if ($isHead && $data['availability_status'] === 'On Leave') {
            return redirect()->back()->withInput()->withErrors(['is_head' => 'Teachers on leave cannot be appointed as Head of Department.']);
        }

        if ($isHead) {
            // unset other heads
            Teacher::where('is_head', true)->where('id', '!=', $teacher->id)->update(['is_head' => false]);
        }

        $updateData = [
            'is_head' => $isHead,
            'name' => $data['name'],
            'designation' => $data['designation'],
            'availability_status' => $data['availability_status'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'office_room' => $data['office_room'] ?? null,
            'website_url' => $data['website_url'] ?? null,
            'profile_image' => $data['profile_image'] ?? null,
            'short_bio' => $data['short_bio'] ?? null,
            'research_interests' => $data['research_interests'] ?? null,
            'education' => $this->splitToArray($data['education'] ?? null),
            'honors' => $this->splitToArray($data['honors'] ?? null),
            'courses' => $this->splitToArray($data['courses'] ?? null),
            'publications' => $data['publications'] ?? null,
        ];

        // Only update password if provided
        if (!empty($data['password'])) {
            $updateData['password'] = Hash::make($data['password']);
        }

        $teacher->update($updateData);

        return redirect()
            ->route('admin.dashboard')
            ->with('status', 'Teacher profile updated successfully.');
    }

    /**
     * Remove the specified teacher profile.
     */
    public function destroy(Teacher $teacher): RedirectResponse
    {
        $teacherName = $teacher->name;
        $teacher->delete();

        return redirect()
            ->route('admin.dashboard')
            ->with('status', "Teacher profile for {$teacherName} has been deleted.");
    }



    /**
     * Turn newline separated textarea input into a clean array payload.
     */
    private function splitToArray(?string $value): array
    {
        return collect(preg_split("/(\r\n|\r|\n)/", (string) $value))
            ->map(fn ($item) => trim($item))
            ->filter()
            ->values()
            ->all();
    }
}
