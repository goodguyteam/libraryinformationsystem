<?php

namespace LIS\Http\Controllers;

use Illuminate\Http\Request;

class CondemnedReportController extends Controller
{
                public function index()
    {
        return view ('report.condemned-report');
    }
}
