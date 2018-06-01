<?php

namespace LIS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LIS\Author;
use LIS\BookAuthor;
use LIS\BookGenre;
use LIS\BookInfo;
use LIS\BookSubject;
use LIS\Classification;
use LIS\Edition;
use LIS\Genre;
use LIS\Publisher;
use LIS\Subject;
use SebastianBergmann\Comparator\Book;

class BookInfosCRUDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = DB::table('book_infos as bi')
            ->select('bi.id as id', 'bi.title as title', 'bi.copyright as copyright', 'p.name as publisher', 'bi.edition as edition', 'c.code as classification')
            ->join('publishers as p', 'p.id', '=', 'bi.publisher_id')
            ->join('classifications as c', 'c.id', '=', 'bi.class_id')
            ->get();

        $book_authors = BookAuthor::all();
        $authors = Author::all();
        $book_genres = BookGenre::all();
        $genres = Genre::all();
        $book_subjects = BookSubject::all();
        $subjects = Subject::all();
        $editions = Edition::all();
        $publishers = Publisher::all();
        $classifications = Classification::all();

        return view('transaction.book-infos', compact('books', 'book_authors', 'authors', 'book_genres', 'genres', 'book_subjects', 'subjects', 'editions', 'publishers', 'classifications'));
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
        $book = new BookInfo();
        $book->title = $request->title;
        $book->edition = $request->edition;
        $book->copyright = date('Y-m-d', strtotime($request->copyright.'-01-01'));
        $book->publisher_id = Publisher::where('id', $request->publisher_id)->first()->id;
        $book->class_id = Classification::where('code', $request->class_code)->first()->id;
        $book->save();

        $book_id = BookInfo::orderBy('created_at', 'desc')->first()->id;

        foreach ($request->authors as $author){
            $book_author = new BookAuthor();
            $book_author->book_id = $book_id;
            $book_author->author_id = $author;
            $book_author->save();
        }

        foreach ($request->genres as $genre){
            $book_genre = new BookGenre();
            $book_genre->book_id = $book_id;
            $book_genre->genre_id = $genre;
            $book_genre->save();
        }

        if (!empty($request->subjects)) {
            foreach ($request->subjects as $subject){
                $book_subject = new BookSubject();
                $book_subject->book_id = $book_id;
                $book_subject->subject_id = $subject;
                $book_subject->save();
            }
        }
        return redirect(route('book-infos.index'))->with('message', 'Book Info Added Successfully');
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
