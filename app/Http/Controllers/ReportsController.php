<?php

namespace LIS\Http\Controllers;

use Illuminate\Http\Request;
use LIS\Genre;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class ReportsController extends Controller
{
    public function genres(){
        $genres = Genre::all();
        $pdf = PDF::loadView('pdf.document', compact('genres'), [], [
            'format' => 'A4-L'
        ]);
        return $pdf->stream('document.pdf');
    }
}
