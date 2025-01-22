<?php

namespace App\Http\Controllers;

use App\Models\StudentProfile;
use Illuminate\Http\Request;

class StudentProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $students = StudentProfile::get();
        return view('student.index
        '
        , compact('students'));
        
        }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|min:3|max:255',
            'gender'        => 'required|in:male,female',
            'phone_number'  => 'required|regex:/^60[0-9]{9,10}$/|unique:student_profiles,phone_number',
            'matric_number' => 'required|regex:/^D[0-9]{11}$/|unique:student_profiles,matric_number',
            'address'       => 'nullable|string',
            'age'           => 'required|numeric|between:17,90',
        ]);

        try {
            $storeStudent = new StudentProfile();
            $storeStudent->name = $request->name;
            $storeStudent->gender = $request->gender;
            $storeStudent->phone_number = $request->phone_number;
            $storeStudent->matric_number = $request->matric_number;
            $storeStudent->address = $request->address;
            $storeStudent->age = $request->age;
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->route('students.create')->with('error', 'Student unable to save');
        }
        $storeStudent->save();
        return redirect()->route('students.index')->with('success', 'Student saved successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $editStudent = StudentProfile::findOrFail($student);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->route('students.index')->with('error', 'Student not found');
        }
        return view('student.show', compact('editStudent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $editStudent = StudentProfile::findOrFail($student);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->route('students.index')->with('error', 'Student not found');
        }
        return view('student.edit', compact('editStudent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'          => 'required|string|min:3|max:255',
            'gender'        => 'required|in:male,female',
            'phone_number'  => 'required|regex:/^60[0-9]{9,10}$/|unique:student_profiles,phone_number,' . $student,
            'matric_number' => 'required|regex:/^D[0-9]{11}$/|unique:student_profiles,matric_number,' . $student,
            'address'       => 'nullable|string',
            'age'           => 'required|numeric|between:17,90',
        ]);

        try {
            $storeStudent = StudentProfile::findOrFail($student);
            $storeStudent->name = $request->name;
            $storeStudent->gender = $request->gender;
            $storeStudent->phone_number = $request->phone_number;
            $storeStudent->matric_number = $request->matric_number;
            $storeStudent->address = $request->address;
            $storeStudent->age = $request->age;
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->route('students.edit', $student)->with('error', 'Student unable to update');
        }
        $storeStudent->save();
        return redirect()->route('students.index')->with('success', 'Student updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $deleteStudent = StudentProfile::findOrFail($student);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->route('students.index')->with('error', 'Student not found');
        }
        $deleteStudent->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully');
    }
}
