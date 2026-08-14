<?php

namespace App\Services;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Events\StudentCreated;
use Illuminate\Support\Facades\Storage;
use App\Jobs\SendWelcomeEmailJob;
class StudentService
{
public function store(Request $request){
$data = $request->validated();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('students', 'public');
        }

        $student = Student::create($data);
        // SendWelcomeEmailJob::dispatch($student);



        event(new StudentCreated($student));
}
public function update($request, Student $student)
{
    $data = $request->validated();

    if ($request->hasFile('photo')) {

        if ($student->photo && Storage::disk('public')->exists($student->photo)) {
            Storage::disk('public')->delete($student->photo);
        }

        $data['photo'] = $request->file('photo')->store('students', 'public');
    }

    $student->update($data);
}
}
