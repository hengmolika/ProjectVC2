<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Student::latest()->get();
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
            'first_name' => 'max:10|required',
            'last_name' => 'max:10|required',
            'gender' => 'required',
            'profile' => 'nullable|image|mimes:jpg,jpeg,png|max:1999|',
            'class_name' => 'required',
            'phone' => 'required|min:9|numeric',
        ]);
        $student = new Student();
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->gender = $request->gender;
        $student->profile = $request->profile;
        $student->class_name = $request->class_name;
        $student->phone = $request->phone;
        $student->user_id = $request->user_id;
        $student->save();

        return response()->json(['message' => 'Student created!'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Student::findOrFail($id);
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
            'first_name' => 'min:1|max:10',
            'last_name' => 'min:1|max:10',
            'gender' => 'required',
            'profile' => 'nullable|image|mimes:jpg,jpeg,png|max:1999|',
            'class_name' => 'required',
            'phone' => 'required|min:11|numeric',
        ]);
        $student = Student::findOrFail($id);
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->gender = $request->gender;
        $student->profile = $request->profile;
        $student->class_name = $request->class_name;
        $student->phone = $request->phone;
        $student->user_id = $request->user_id;
        $student->save();

        return response()->json(['message' => 'Student updated!'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Student::destroy($id);
    }
}
