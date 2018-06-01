<?php

namespace LIS\Http\Controllers;

use Illuminate\Http\Request;

class WeedingPDFController extends Controller
{
                    public function index()
    {
        return view ('report.weeding-pdf');
    }
}
