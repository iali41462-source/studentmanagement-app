<?php

namespace App\Http\Controllers\Api\V2;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Http\Requests\StudentRequest;
use App\Http\Resources\StudentResource;
// use App\Http\Requests\LoginApiRequest;
use App\Http\Resources\StudentCollection;

class StudentApiController extends Controller
{

public function index(Request $request)
{
    /**
 * @OA\Get(
 *     path="/api/v2/students",
 *     summary="Get Students"
 * )
 */

    $search = $request->search;

    $allowedSorts = ['id', 'name', 'email', 'created_at'];

    $sort = $request->sort ?? 'id';

    if (!in_array($sort, $allowedSorts)) {
        $sort = 'id';
    }

    $order = strtolower($request->order) == 'desc' ? 'desc' : 'asc';

    $students = Student::query();

    if ($search) {
        $students->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('address', 'like', "%{$search}%")
              ->orWhere('mobile', 'like', "%{$search}%");
    }

    $students = $students
        ->orderBy($sort, $order)
        ->paginate(5);
  return response()->json([
        'status'  => true,
        'version' => 'v2',
        'message' => 'Students fetched successfully VIA V2 API.',
        'students' => $students
    ]);
}


    //public function store() create a new student
public function store(StudentRequest $request)
{
    $data = $request->validated();

    if ($request->hasFile('photo')) {

        $data['photo'] = $request->file('photo')->store('students', 'public');

    }

    $student = Student::create($data);

    return response()->json([
        'success' => true,
        'message' => 'Student created successfully.',
        'data' => new StudentResource($student)
    ], 201);
}
public function update(StudentRequest $request, Student $student)
{
    $student->update($request->validated());

    return response()->json([
        'success' => true,
        'message' => 'Student updated successfully.',
        'data' => $student
    ], 200);
}
    //public function show(Student $student) show a specific student
// public function show(Student $student)
// {
//     // return new StudentResource($student);
//     // return new StudentResource($student);

// }
// public function show($id)
// {
//     $student = Student::find($id);

//     if (!$student) {

//         return response()->json([
//             'success' => false,
//             'message' => 'Student not found.'
//         ], 404);

//     }

//     return response()->json([
//         'success' => true,
//         'message' => 'Student fetched successfully.',
//         'data' => new StudentResource($student)
//     ]);
// }
public function show(Student $student)
{
    return response()->json([
        'success' => true,
        'message' => 'Student has fetched successfully.',
        'data' => new StudentResource($student)
    ]);
}
public function destroy(Student $student)
{
    $student->delete();

    return response()->json([
        'success' => true,
        'message' => 'Student deleted successfully.'
    ], 200);
}
}
