<?php

namespace LIS\Http\Controllers;

use Illuminate\Http\Request;
use LIS\Http\Controllers\Controller;
use LIS\DisposalType;
use LIS\DisposalInfo;
use LIS\BookAuthor;
use LIS\AcquisitionInfo;
use LIS\BookInventory;
use LIS\Author;
use Validator;
use Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class DisposalCRUDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $book_inventory = DB::table('book_inventories as binv')
      ->select('binv.id as id', 'binv.book_status_id as status_id',
      'binv.book_info_id as bi_id', 'c.code as loc', 'binf.title as title',
      'a.name as author', 'p.name as publisher', 'c.code as type', 's.name as status',
      'binv.updated_at as date', 'binv.disposal_info_id' )
      ->join('book_infos as binf', 'binv.book_info_id', '=', 'binf.id')
      ->join('classifications as c', 'binf.class_id', '=', 'c.id')
      ->join('book_authors as ba', 'ba.book_id', '=', 'binf.id')
      ->join('authors as a', 'ba.author_id', '=', 'a.id')
      ->join('publishers as p', 'binf.publisher_id', '=', 'p.id')
      ->join('book_inventory_statuses as s', 'binv.book_status_id', '=', 's.id')
      ->join('acquisition_infos as ai', 'binv.acquisition_info_id', '=', 'ai.id')
      // ->join('disposal_infos as di', 'binv.disposal_info_id', '=', 'di.id')
      // ->join('disposal_types as dt', 'di.disposal_type_id', '=', 'dt.id')
      ->whereNull('binv.disposal_info_id')
      ->get();

      // $book_inventory1 = DB::table('book_inventories as binv')
      // ->select()

      $types = DisposalType::all();
      $book_authors = BookAuthor::all();
      $acquisition_infos = AcquisitionInfo::all();
      $authors = Author::all();

      return view('transaction.disposal-infos', compact('book_inventory', 'types', 'book_authors', 'acquisition_infos', 'authors'));
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
      $dispose = new DisposalInfo();
       $dispose->disposal_type_id = Input::get('disposal_type_id');
       $dispose->remarks = Input::get('remarks');

       $dispose->save();
       return response()->json($dispose);
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
        //
    }
}
