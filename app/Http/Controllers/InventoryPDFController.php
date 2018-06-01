<?php

namespace LIS\Http\Controllers;

use Illuminate\Http\Request;

class InventoryPDFController extends Controller
{
            public function index()
    {
        return view ('report.inventory-pdf');
    }
}
