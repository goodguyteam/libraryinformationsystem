<?php

namespace LIS\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use LIS\LibraryLog;
use LIS\StudentInfo;
use Illuminate\Support\Facades\DB;

class AndroidScannerController extends Controller
{
    public function login(Request $request){
        if(!is_null($student = StudentInfo::where('student_number', Input::get('student_no_post'))->first())){
            if(!is_null(LibraryLog::where('student_number', $student->student_number)->where('log_status', 0)->first())){
                return "Do you want to leave the library"." ".$student->first_name." ?";
            }
            else{

                $log = new LibraryLog();
                $log->student_number = $student->student_number;
                $log->log_date = date('Y-m-d', Carbon::now()->timestamp);
                $log->time_in = date('H:i:s', Carbon::now()->timestamp);
                $log->save();

                return 'Welcome to library, '.$student->first_name;
            }
        }

        return 'Account doesn\'t exist';
    }

    public function logout(Request $request){
        $log = LibraryLog::where('student_number', $request->student_no_post1)->first();
        $log->time_out = date('H:i:s', Carbon::now()->timestamp);
        $log->log_status = true;
        $log->save();
        return 'Thank you for using the library! Come again :)';
    }

    public function picture(Request $request){
        $picture = StudentInfo::where('student_number', $request->student_no_post2)->first()->image_path;
        if(isset($picture)){
            return asset($picture);
        }
        return '';
    }

    public function logs(Request $request){
        $logs = DB::table('student_infos as U')
            ->select('U.student_number as student_number', 'U.first_name as first_name', 'U.middle_name as middle_name', 'U.last_name as last_name', 'S.course_id as course', 'S.year_id as year', 'S.section_id as section', 'U.image_path as image_path', 'L.log_date as log_date', 'L.time_in as time_in', 'L.time_out as time_out')
            ->join('student_sections as S', 'S.id', '=', 'U.course_section_id')
            ->join('library_logs as L', 'L.student_number', '=', 'U.student_number')
            ->where('log_date', date('Y-m-d', Carbon::now()->timestamp))
            ->get();

        $log_list = array();
        for($i = 0; $i < count($logs); $i++){
            $log_list[$i]['u_student_no'] = 'Student number:  '.$logs[$i]->student_number;
            $log_list[$i]['u_name'] = 'Name:  '.$logs[$i]->last_name.' '.$logs[$i]->first_name.' '.$logs[$i]->middle_name.'.';
            $log_list[$i]['u_course_ys'] = 'Year & Section:  '.$logs[$i]->course.'  '.$logs[$i]->year.' '.$logs[$i]->section;
            $log_list[$i]['u_imageurl'] = $logs[$i]->image_path;
            $log_list[$i]['l_logs_datein'] = 'Date: '.$logs[$i]->log_date;
            $log_list[$i]['l_logs_timein'] = 'Time in:  '.$logs[$i]->time_in;
            if(is_null($logs[$i]->time_out))
                $log_list[$i]['l_logs_timeout'] = 'Time out:  '.'Currently inside';
            else
                $log_list[$i]['l_logs_timeout'] = 'Time out:  '.$logs[$i]->time_out;
        };
        return $log_list;
    }
}
