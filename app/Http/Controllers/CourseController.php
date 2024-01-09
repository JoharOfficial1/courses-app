<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Course;
use App\Models\CourseAssign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all();

        return view('courses.index')->with('courses', $courses);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'course_file' => 'required|mimes:zip,rar,pdf,doc,docx'
        ]);

        $course = new Course();
        $course->name = $request->name;

        if ($request->file('course_file')) {
            $courseFile = $request->file('course_file');
            $courseFileName = time() . '-' . $request->name . '.' . $courseFile->getClientOriginalExtension();
            $courseFile->move(public_path('storage/course-files'), $courseFileName);
        
            $course->course_file = 'storage/course-files/' . $courseFileName;
        }

        if ($course->save()) {
            Session::flash('success', 'Course is stored successfully');

            return redirect()->route('courses.index');
        } else {
            Session::flash('error', 'Something went wrong while storing course');

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
        $course = Course::find($id);

        if ($course) {
            return view('courses.edit')->with('course', $course);
        } else {
            Session::flash('error', 'Course not found');

            return redirect()->route('courses.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'file' => 'nullable|mimes:zip,rar,pdf,doc,docx'
        ]);

        $course = Course::find($id);

        if ($course) {
            $course->name = $request->name;

            if ($request->file('course_file')) {
                $oldCourseFilePath = public_path($course->course_file);

                if (File::exists($oldCourseFilePath)) {
                    File::delete($oldCourseFilePath);
                }

                $courseFile = $request->file('course_file');
                $courseFileName = time() . '-' . $request->name . '.' . $courseFile->getClientOriginalExtension();
                $courseFile->move(public_path('storage/course-files'), $courseFileName);
            
                $course->course_file = 'storage/course-files/' . $courseFileName;
            }

            if ($course->save()) {
                Session::flash('success', 'Course is updated successfully');

                return redirect()->route('courses.index');
            } else {
                Session::flash('error', 'Something went wrong while updating course');

                return back()->withInputs($request->all());
            }
        } else {
            Session::flash('error', 'Course not found');

            return redirect()->route('courses.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $course = Course::find($id);

        if ($course) {
            $courseFilePath = public_path($course->course_file);

            if ($course->delete()) {
                if (File::exists($courseFilePath)) {
                    File::delete($courseFilePath);
                }
                
                Session::flash('success', 'Course is deleted successfully');

                return redirect()->route('courses.index');
            } else {
                Session::flash('success', 'Something went wrong while deleting course');

                return redirect()->route('courses.index');
            }
        } else {
            Session::flash('error', 'Course not found');

            return redirect()->route('courses.index');
        }
    }
}
