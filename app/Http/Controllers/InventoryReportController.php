<?php

namespace LIS\Http\Controllers;

use Illuminate\Http\Request;

class InventoryReportController extends Controller
{
        public function index()
    {
        return view ('report.inventory-report');
    }
}
