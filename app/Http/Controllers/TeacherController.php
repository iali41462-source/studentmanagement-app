<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\TeacherRequest;
use Illuminate\Http\Response;
use App\Models\Teacher;
use Illuminate\View\View;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $teachers = Teacher::all();
        return view ('teachers.index')->with('teachers', $teachers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('teachers.create');


    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(TeacherRequest $request)
{
    Teacher::create($request->validated());

    return redirect()->route('teachers.index')
                     ->with('flash_message', 'Teacher Added Successfully!');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $teachers = Teacher::find($id);
        return view('teachers.show')->with('teachers', $teachers);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $teachers = Teacher::find($id);
        return view('teachers.edit')->with('teachers', $teachers);
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(TeacherRequest $request, string $id)
{
    $teacher = Teacher::find($id);

    $teacher->update($request->validated());

    return redirect()->route('teachers.index')
                     ->with('flash_message', 'Teacher Updated Successfully!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        Teacher::destroy($id);
        return redirect('teachers')->with('flash_message', 'Teacher deleted!');
    }
}
