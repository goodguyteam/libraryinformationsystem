<?php

namespace LIS\Http\Controllers;

use Illuminate\Http\Request;
use LIS\Http\Controllers\Controller;

class CirculationReportController extends Controller
{
                public function index()
    {
        return view ('report.circulation-report');
    }
}
