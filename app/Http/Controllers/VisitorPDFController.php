<?php

namespace LIS\Http\Controllers;

use Illuminate\Http\Request;
use LIS\Http\Controllers\Controller;

class VisitorPDFController extends Controller
{
                    public function index()
    {
        return view ('report.visitor-pdf');
    }
}
