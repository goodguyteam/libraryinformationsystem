<?php

namespace LIS\Http\Controllers;

use Illuminate\Http\Request;

class WeedingReportController extends Controller
{
                    public function index()
    {
        return view ('report.weeding-report');
    }
}
