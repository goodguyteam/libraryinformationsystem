<?php

namespace LIS\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use LIS\StudentInfo;

class StudentInfosCRUDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = DB::table('student_infos as student')
                    ->selectRaw('student.id as id, student.student_number as student_number, student.first_name as first_name, student.last_name as last_name, c.name as course, y.id as year, s.id as section, student.image_path as image_path')
                    ->join('student_sections as section', 'student.course_section_id', '=', 'section.id')
            ->join('courses as c', 'c.id', '=', 'section.course_id')
            ->join('sections as s', 's.id', '=', 'section.section_id')
            ->join('years as y', 'y.id', '=', 'section.year_id')
                    ->get();
        return view('system-setup.student-info', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new StudentInfo();
        $user->student_number = $request->student_number;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->middle_name = $request->middle_name or null;

        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $save_path = 'img\user_avatars\\';
            $filename = 'IMG_' . str_random(4) . '_' . Carbon::now()->timestamp .  '.jpg';
            if (!file_exists($save_path)) {
                mkdir($save_path, 666, true);
            }
            ini_set('memory_limit', '512M');
            $height = Image::make($avatar)->height();
            $width = Image::make($avatar)->width();
            if($width < $height)
                Image::make($avatar)->crop($width, $width)->encode('jpg', 75)->save( public_path($save_path . $filename));
            else
                Image::make($avatar)->crop($height, $height)->encode('jpg', 75)->save( public_path($save_path . $filename));
            $user->image_path = $save_path . $filename;

        }
        $user->save();
        return redirect(route('student-management.index'))->with('message', 'Student Image Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $save_path = 'img\user_avatars\\';
            $filename = 'IMG_' . str_random(4) . '_' . Carbon::now()->timestamp .  '.jpg';
            if (!file_exists($save_path)) {
                mkdir($save_path, 666, true);
            }
            ini_set('memory_limit', '512M');
            $height = Image::make($avatar)->height();
            $width = Image::make($avatar)->width();
            if($width < $height)
                Image::make($avatar)->crop($width, $width)->encode('jpg', 75)->save( public_path($save_path . $filename));
            else
                Image::make($avatar)->crop($height, $height)->encode('jpg', 75)->save( public_path($save_path . $filename));
            $user = StudentInfo::where('id', $id)->first();
            $user->image_path = $save_path . $filename;
            $user->save();

            return redirect(route('student-management.index'))->with('message', 'Student Image Updated Successfully');
        }

        return redirect(route('student-management.index'))->with('message', 'Student Image Updating Failed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
