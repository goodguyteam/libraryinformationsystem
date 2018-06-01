<?php

namespace LIS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use LIS\AcquisitionInfo;
use LIS\AcquisitionType;
use LIS\Author;
use LIS\BookAuthor;
use LIS\BookInfo;

class AcquisitionInfosCRUDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $acquisition_infos = AcquisitionInfo::where('cancelled', false)->get();
        $acquisition_types = AcquisitionType::all();
        $book_infos = BookInfo::all();
        $book_authors = BookAuthor::all();
        $authors = Author::all();

        return view('transaction.acquisition-infos', compact('authors', 'book_authors', 'acquisition_infos', 'acquisition_types', 'book_infos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $acquisition_info = new AcquisitionInfo();
        $acquisition_info->book_id = $request->book_id;
        $acquisition_info->acquisition_type_id = AcquisitionType::where('id', $request->acquisition_type_id)->first()->id;
        $acquisition_info->quantity = $request->quantity;
        $acquisition_info->date_acquired = date('Y-m-d', strtotime(\Carbon\Carbon::now()));
        $acquisition_info->save();

        return redirect(route('acquisition-infos.index'))->with('message', 'Book Acquisition is Successfully Finished');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $acquisition_info = AcquisitionInfo::where('id', $id)->first();
        $acquisition_info->cancelled = true;
        $acquisition_info->save();

        if(Input::get('_page') == 'AQ')
            return redirect(route('acquisition-infos.index'))->with('message', 'Acquisition Cancelled Successfully');
        else if(Input::get('_page') == 'IN')
            return redirect(route('book-inventories.index'))->with('message', 'Acquisition Cancelled Successfully');
    }
}
