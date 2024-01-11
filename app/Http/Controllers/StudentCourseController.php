<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\StudentCourse;
use Illuminate\Support\Facades\File;

class StudentCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studentCourses = StudentCourse::all();

        return view('student-courses.index')->with('studentCourses', $studentCourses);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::all();

        return view('student-courses.create')->with('courses', $courses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'roll_number' => 'required',
            'serial_number' => 'required',
            'course' => 'required',
        ]);

        $studentCourse = new StudentCourse();
        $studentCourse->roll_number = $request->roll_number;
        $studentCourse->serial_number = $request->serial_number;
        $studentCourse->course_id = $request->course;

        if ($studentCourse->save()) {
            Session::flash('success', 'Student course is stored successfully');

            return redirect()->route('student-courses.index');
        } else {
            Session::flash('error', 'Something went wrong while storing student course');

            return back()->withInputs($request->all());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $studentCourse = StudentCourse::find($id);

        if ($studentCourse) {
            $courses = Course::all();
            
            return view('student-courses.edit')->with('courses', $courses)->with('studentCourse', $studentCourse);
        } else {
            Session::flash('error', 'Student course not found');

            return redirect()->route('student-courses.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'roll_number' => 'required',
            'serial_number' => 'required',
            'course' => 'required',
        ]);

        $studentCourse = StudentCourse::find($id);

        if ($studentCourse) {
            $studentCourse->roll_number = $request->roll_number;
            $studentCourse->serial_number = $request->serial_number;
            $studentCourse->course_id = $request->course;

            if ($studentCourse->save()) {
                Session::flash('success', 'Student course is updated successfully');

                return redirect()->route('student-courses.index');
            } else {
                Session::flash('error', 'Something went wrong while updating student course');

                return back()->withInputs($request->all());
            }
        } else {
            Session::flash('error', 'Student course not found');

            return redirect()->route('student-courses.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $studentCourse = StudentCourse::find($id);

        if ($studentCourse) {
            if ($studentCourse->delete()) {
                Session::flash('success', 'Student course is deleted successfully');

                return redirect()->route('student-courses.index');
            } else {
                Session::flash('success', 'Something went wrong while deleting student course');

                return redirect()->route('student-courses.index');
            }
        } else {
            Session::flash('error', 'Student course not found');

            return redirect()->route('student-courses.index');
        }
    }

    /**
     * Display course verify page.
     */
    public function verify(Request $request)
    {
        $studentCourses = StudentCourse::where("$request->search_type", $request->number)->get();

        if ($studentCourses->isNotEmpty()) {
            return view('student-courses.verified-courses')->with('studentCourses', $studentCourses);
        } else {
            Session::flash('error', "No Course found");

            return back()->withInputs($request->all());
        }
    }
}
