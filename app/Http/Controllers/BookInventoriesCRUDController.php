<?php

namespace LIS\Http\Controllers;

use Illuminate\Http\Request;
use LIS\AcquisitionInfo;
use LIS\AcquisitionType;
use LIS\BookAuthor;
use LIS\BookInfo;
use LIS\Author;
use LIS\BookInventory;
use LIS\BookInventoryStatus;
use LIS\BookShelving;
use LIS\Classification;
use LIS\LibraryShelf;
use LIS\ShelfSections;

class BookInventoriesCRUDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $acquisition_infos = AcquisitionInfo::all();
        $acquisition_types = AcquisitionType::all();
        $book_infos = BookInfo::all();
        $book_authors = BookAuthor::all();
        $authors = Author::all();
        $shelves = LibraryShelf::all();
        $classifications = Classification::all();
        $book_inventories = BookInventory::all();
        $book_shelves = BookShelving::all();
        $shelf_sections = ShelfSections::all();
        return view('transaction.book-inventories', compact('authors', 'book_authors', 'acquisition_infos', 'acquisition_types', 'book_infos', 'shelves', 'classifications', 'book_inventories', 'book_shelves', 'shelf_sections'));
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
        for ($i = 0; $i < count($request->isbn); $i++){
            $shelving = new BookShelving();
            $shelving->class_id = $request->class_id;
            $shelving->shelf_id = LibraryShelf::where('code', $request->shelf_code)->first()->id;
            $shelving->section_id = ShelfSections::where('prefix', $request->section_code)->first()->id;
            $shelving->call_number = $request->call_number[$i];
            $shelving->book_sequence = $request->book_sequence[$i];
            $shelving->save();

            $shelving_id = BookShelving::where('call_number', $request->call_number[$i])->first()->id;

            $inventory = new BookInventory();
            $inventory->shelving_id = $shelving_id;
            $inventory->book_info_id = $request->book_info_id;
            $inventory->acquisition_info_id = $request->acquisition_info_id;
            $inventory->isbn = $request->isbn[$i];
            $inventory->accession_number = $request->accession_number[$i];
            $inventory->book_status_id = BookInventoryStatus::where('code', 'gcndtn')->first()->id;
            $inventory->save();
        }

        return redirect(route('book-inventories.index'))->with('message', 'Inventorying Successful');
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
        $inventory = BookInventory::where('id', $id)->first();
        $inventory->isbn = $request->isbn;
        $inventory->accession_number = $request->accession_number;
        $inventory->book_status_id = BookInventoryStatus::where('code', $request->book_status_code)->first()->id;
        $inventory->save();

        $shelving = BookShelving::where('id', $inventory->book_status_id)->first();
        $shelving->call_number = $request->call_number;
        $shelving->book_sequence = $request->book_sequence;
        $shelving->save();

        return redirect(route('book-inventories.index'))->with('message', 'Edited the Copy Successful');
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
