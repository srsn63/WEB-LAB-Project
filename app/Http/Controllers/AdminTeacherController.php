<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminTeacherController extends Controller
{
    /**
     * Persist a freshly created teacher profile from the admin panel.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'designation' => ['required', 'string', 'in:Professor,Associate Professor,Assistant Professor,Lecturer'],
            'department' => ['required', 'string', 'max:255'],
            'availability_status' => ['nullable', 'string', 'in:Available,On Leave'],
            'email' => ['nullable', 'email', 'max:255'],
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
        ]);

        $slug = $this->resolveUniqueSlug($data['slug'] ?? null, $data['name']);

        Teacher::create([
            'name' => $data['name'],
            'slug' => $slug,
            'designation' => $data['designation'],
            'department' => $data['department'],
            'availability_status' => $data['availability_status'] ?? null,
            'email' => $data['email'] ?? null,
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
            ->with('status', 'Teacher profile created successfully.');
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
            'slug' => ['nullable', 'string', 'max:255'],
            'designation' => ['required', 'string', 'in:Professor,Associate Professor,Assistant Professor,Lecturer'],
            'department' => ['required', 'string', 'max:255'],
            'availability_status' => ['nullable', 'string', 'in:Available,On Leave'],
            'email' => ['nullable', 'email', 'max:255'],
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
        ]);

        $slug = $this->resolveUniqueSlugForUpdate($data['slug'] ?? null, $data['name'], $teacher);

        $teacher->update([
            'name' => $data['name'],
            'slug' => $slug,
            'designation' => $data['designation'],
            'department' => $data['department'],
            'availability_status' => $data['availability_status'] ?? null,
            'email' => $data['email'] ?? null,
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
     * Build a slug and ensure it remains unique in the teachers table.
     */
    private function resolveUniqueSlug(?string $requestedSlug, string $name): string
    {
        $baseSlug = Str::slug($requestedSlug ?: $name);

        if ($baseSlug === '') {
            $baseSlug = 'teacher-'.Str::random(6);
        }

        $slug = $baseSlug;
        $suffix = 1;

        while (Teacher::where('slug', $slug)->exists()) {
            $slug = $baseSlug.'-'.($suffix++);
        }

        return $slug;
    }

    /**
     * Build a unique slug for updates, excluding the current teacher.
     */
    private function resolveUniqueSlugForUpdate(?string $requestedSlug, string $name, Teacher $teacher): string
    {
        $baseSlug = Str::slug($requestedSlug ?: $name);

        if ($baseSlug === '') {
            $baseSlug = 'teacher-'.Str::random(6);
        }

        $slug = $baseSlug;
        $suffix = 1;

        while (Teacher::where('slug', $slug)->where('id', '!=', $teacher->id)->exists()) {
            $slug = $baseSlug.'-'.($suffix++);
        }

        return $slug;
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
