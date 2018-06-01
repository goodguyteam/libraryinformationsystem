<?php

namespace LIS\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use LIS\LibraryLog;
use LIS\StudentInfo;

class AndroidScannerController extends Controller
{
    public function login(Request $request){
        $student = StudentInfo::where('student_number', $request->student_number_login)->first();
        if(!is_null($student)){
            $checklog = LibraryLog::where('student_number', $student->student_number)
                ->where('log_status', 0)
                ->first();

            if(is_null($checklog)){
                $log = new LibraryLog();
                $log->student_number = $student->student_number;
                $log->log_date = date('Y-m-d', Carbon::now()->timestamp);
                $log->time_in = date('H:i:s', Carbon::now()->timestamp);
                $log->save();

                return 'Welcome to library, '.$student->first_name;
            }
            return "Logout"." ".$student->first_name." ?";
        }
        return 'Account doesn\'t exist';
    }

    public function logout(Request $request){
        $log = LibraryLog::where('student_number', $request->student_number_logout)->first();
        $log->time_out = date('H:i:s', Carbon::now()->timestamp);
        $log->log_status = true;
        if($log->save()){
            return 'Thank you for using the library! Come again :)';
        }
        return 'ERROR OCCURRED';
    }

    public function picture(Request $request){
        $picture = StudentInfo::where('student_number', $request->student_number_picture)->first()->image_path;
        if(isset($picture)){
            return asset($picture);
        }
        return 'NULL';
    }
}
