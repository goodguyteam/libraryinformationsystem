<?php

namespace LIS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LIS\Author;
use LIS\Gender;

class AuthorsCRUDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = DB::table('authors as a')
            ->select('a.id as id', 'a.name as name', 'g.name as gender')
            ->join('genders as g', 'a.gender_id', '=', 'g.id')
            ->get();
        $genders = Gender::all();
        return view('system-setup.authors', compact('authors', 'genders'));
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
        $author = new Author();
        $author->name = $request->name;
        $author->gender_id = $request->gender;
        $author->save();

        return redirect(route('authors.index'))->with('message', 'Author Added Successfully');
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
        $author = Author::where('id', $id)->first();
        $author->name = $request->name;
        $author->gender_id = $request->gender;
        $author->save();

        return redirect(route('authors.index'))->with('message', 'Author Updated Successfully');
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
