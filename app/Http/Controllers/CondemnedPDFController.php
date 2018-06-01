<?php

namespace LIS\Http\Controllers;

use Illuminate\Http\Request;

class CondemnedPDFController extends Controller
{
                public function index()
    {
        return view ('report.condemned-pdf');
    }
}
