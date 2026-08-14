<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StudentRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use App\Models\Student;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use SoftDeletes;
use App\Services\StudentService;
use App\Models\User;
use App\Notifications\StudentWelcomeNotification;



class StudentController extends Controller
{
    protected $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

public function index(Request $request): View
{

$this->authorize('viewAny', Student::class);
    $search = $request->search;
    $sort = $request->sort;
 $students = Student::query();
   // Search
    if ($search) {
        $students->where('name', 'like', "%{$search}%");
    }

    // Sorting
    if ($sort == 'name_asc') {
        $students->orderBy('name', 'asc');
    }

    if ($sort == 'name_desc') {
        $students->orderBy('name', 'desc');
    }

    if ($sort == 'latest') {
        $students->orderBy('id', 'desc');
    }

    if ($sort == 'oldest') {
        $students->orderBy('id', 'asc');
    }

    $students = $students->paginate(5)
                         ->appends($request->query());

    return view('students.index', compact('students'));
}
    /**
     * Display a listing of the resource.
     */



    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
{
    $this->authorize('create', Student::class);

    return view('students.create' );
}

    /**
     * Store a newly created resource in storage.
     */
public function store(StudentRequest $request): RedirectResponse
{
        $this->authorize('create', Student::class);

        $this->studentService->store($request);

       return redirect('students')
        ->with('success', 'Student Added Successfully!');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $students = Student::find($id);
        return view('students.show')->with('students', $students);
    }

    /**
     * Show the form for editing the specified resource.
     */
public function edit(Student $student): View
{
    $this->authorize('update', $student);

    return view('students.edit')->with('student', $student);
}

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentRequest $request, Student $student)
{
    $this->authorize('update', $student);

    $this->studentService->update($request, $student);

    return redirect()->route('students.index')
        ->with('success', 'Student Updated Successfully!');
}
// public function update(StudentRequest $request, Student $student): RedirectResponse
// {
//     $this->authorize('update', $student);

//     $data = $request->validated();

//     if ($request->hasFile('photo')) {

//         // Purani image delete karo
//         if ($student->photo && Storage::disk('public')->exists($student->photo)) {
//             Storage::disk('public')->delete($student->photo);
//         }

//         // Nayi image upload karo
//         $data['photo'] = $request->file('photo')->store('students', 'public');
//     }

//     $student->update($data);

//     return redirect('students')
//         ->with('success', 'Student Updated Successfully!');
// }

    /**
     * Remove the specified resource from storage.
     */
public function destroy(Student $student): RedirectResponse
{
    $this->authorize('delete', $student);

    if ($student->photo && Storage::disk('public')->exists($student->photo)) {
        Storage::disk('public')->delete($student->photo);
    }

    $student->delete();

    return redirect('students')
        ->with('success', 'Student Deleted Successfully!');
}
public function restore($id)
{
    Student::onlyTrashed()->findOrFail($id)->restore();

     return redirect('students')
        ->with('success', 'Student Updated Successfully!');
}
}
