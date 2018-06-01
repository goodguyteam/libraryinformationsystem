<?php

namespace LIS\Http\Controllers;

use Illuminate\Http\Request;
use LIS\LibraryShelf;

class LibraryShelvesCRUDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $library_shelves = LibraryShelf::all();
        return view('system-setup.library-shelves', compact('library_shelves'));
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
        $library_shelf = new LibraryShelf();
        $library_shelf->code = $request->code;
        $library_shelf->name = $request->name;
        $library_shelf->save();

        return redirect(route('library-shelves.index'))->with('message', 'Shelf Added Successfully');
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
        $library_shelf = LibraryShelf::where('id', $id)->first();
        $library_shelf->code = $request->code;
        $library_shelf->name = $request->name;
        $library_shelf->save();

        return redirect(route('library-shelves.index'))->with('message', 'Shelf Updated Successfully');
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
