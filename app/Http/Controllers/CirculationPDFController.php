<?php

namespace LIS\Http\Controllers;

use Illuminate\Http\Request;
use LIS\Http\Controllers\Controller;

class CirculationPDFController extends Controller
{
                public function index()
    {
        return view ('report.circulation-pdf');
    }
}
