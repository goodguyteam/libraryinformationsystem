<?php

namespace LIS\Http\Controllers;

use Illuminate\Http\Request;
use LIS\Http\Controllers\Controller;

class MissingPDFController extends Controller
{
                public function index()
    {
        return view ('report.missing-pdf');
    }
}
