<?php

namespace LIS\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use LIS\Author;
use LIS\BookAuthor;
use LIS\BookInventory;
use LIS\BookInventoryStatus;
use Illuminate\Support\Facades\DB;
use LIS\BookShelving;
use LIS\PersonnelInfo;
use LIS\StudentInfo;
use LIS\Transaction;

class BookCirculationCRUDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = DB::table('book_inventories')
            ->where('book_status_id', BookInventoryStatus::where('code', 'gcndtn')->first()->id)
            ->orWhere('book_status_id', BookInventoryStatus::where('code', 'dmgd')->first()->id)
            ->get();
        $book_authors = BookAuthor::all();
        $authors = Author::all();
        $book_shelves = BookShelving::all();
        $students = StudentInfo::all();
        return view('transaction.book-circulations', compact('books', 'book_authors', 'authors', 'book_shelves', 'students'));
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
        $transaction = new Transaction();
        $transaction->code = strtoupper('LIS-'.Carbon::now()->timestamp.'-'.str_random(2).'-'.str_random(1));
        $transaction->date_borrowed = Carbon::now();
        $transaction->date_returned = Carbon::create(9999, 12, 31);
        $transaction->book_copy_id = $request->borrowed_book;

        if($request->_borrower = 'STDNT'){
            $transaction->student_borrower_id = StudentInfo::where('student_number', $request->student_number)->first()->id;
            $transaction->save();
            return redirect(route('book-circulations.index'))->with('message', '(Student) Borrowing Book Successful');
        }
        else if($request->_borrower = 'PRSNNL'){
            $transaction->personnel_borrower_id = PersonnelInfo::where('employee_number', $request->employee_number)->first()->id;
            $transaction->save();
            return redirect(route('book-circulations.index'))->with('message', '(Personnel) Borrowing Book Successful');
        }
        return 'ERROR, PLEASE GO BACK';
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
        $transaction = Transaction::where('id', $id)->first();
        $transaction->date_returned = Carbon::now();
        $transaction->save();

        return redirect(route('book-circulations.index'))->with('message', 'Book Returned Successfully');
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
