<?php

use Illuminate\Database\Seeder;
use LIS\User;
use LIS\SystemInfo;
use LIS\BusinessHours;
use LIS\Course;
use LIS\Year;
use LIS\Author;
use LIS\Publisher;
use LIS\Edition;
use LIS\Classification;
use LIS\BookAuthor;
use LIS\BookSubject;
use LIS\BookGenre;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gender = new \LIS\Gender();
        $gender->code = 'm';
        $gender->name = 'Male';
        $gender->save();

        $gender = new \LIS\Gender();
        $gender->code = 'f';
        $gender->name = 'Female';
        $gender->save();

        $genre = new \LIS\Genre();
        $genre->name = 'Horror';
        $genre->description = 'Horror Book';
        $genre->save();

        $genre = new \LIS\Genre();
        $genre->name = 'Comedy';
        $genre->description = 'Comedy Book';
        $genre->save();

        $genre = new \LIS\Genre();
        $genre->name = 'Fiction';
        $genre->description = 'Fictional Book';
        $genre->save();

        $genre = new \LIS\Genre();
        $genre->name = 'Non-Fiction';
        $genre->description = 'Non-Fictional Book';
        $genre->save();

        $genre = new \LIS\Genre();
        $genre->name = 'Drama';
        $genre->description = 'Drama Book';
        $genre->save();

        $genre = new \LIS\Genre();
        $genre->name = 'Thriller';
        $genre->description = 'Thrilling Book';
        $genre->save();

        $genre = new \LIS\Genre();
        $genre->name = 'Mystery';
        $genre->description = 'Mystery Book';
        $genre->save();

        $genre = new \LIS\Genre();
        $genre->name = 'Supernatural';
        $genre->description = 'Supernatural Book';
        $genre->save();

        $genre = new \LIS\Subject();
        $genre->name = 'Programming';
        $genre->description = 'Programming Book';
        $genre->save();

        $deadline = new \LIS\CirculationDeadlineSetup();
        $deadline->code ='stud';
        $deadline->name = 'Student Deadline';
        $deadline->deadline = 3;
        $deadline->save();

        $deadline = new \LIS\CirculationDeadlineSetup();
        $deadline->code ='fac';
        $deadline->name = 'Faculty Deadline';
        $deadline->deadline = 7;
        $deadline->save();

        $genre = new \LIS\Subject();
        $genre->name = 'Motivational';
        $genre->description = 'Motivational Book';
        $genre->save();

        $author = new Author();
        $author->name = 'Dan Angelo Corporal';
        $author->gender_id = 1;
        $author->save();

        $author = new Author();
        $author->name = 'Jean Ann Ramos';
        $author->gender_id = 2;
        $author->save();

        $class = new Classification();
        $class->code = 'F385';
        $class->name = 'Dissertations and Theses';
        $class->save();

        $edition = new Edition();
        $edition->code = '1st';
        $edition->name = 'First Edition';
        $edition->save();

        $publisher = new \LIS\Publisher();
        $publisher->name = 'Fredish Publishing Inc.';
        $publisher->address = '#123, PD Street, Diliman, Quezon City';
        $publisher->contact_number = '+63 916 700 1819';
        $publisher->save();

        $site = new SystemInfo();
        $site->site_name = 'PUP Resource Learning Center';
        $site->site_abbreviation = 'PUP-RLC';
        $site->save();

        $business_hours = new BusinessHours();
        $business_hours->opening_time = date('H:i:s', strtotime('8:00am'));
        $business_hours->closing_time = date('H:i:s', strtotime('5:00pm'));;
        $business_hours->save();

        $user = new User();
        $user->name = 'Administrator';
        $user->email = 'admin@lis.com';
        $user->password = bcrypt('12345678');
        $user->save();

        $course = new Course();
        $course->code = 'bsit';
        $course->name = 'BS Information Technology';
        $course->save();

        $year = new Year();
        $year->code = '1st';
        $year->year_level = 'First Year';
        $year->save();

        $year = new Year();
        $year->code = '2nd';
        $year->year_level = 'Second Year';
        $year->save();

        $year = new Year();
        $year->code = '3rd';
        $year->year_level = 'Third Year';
        $year->save();

        $year = new Year();
        $year->code = '4th';
        $year->year_level = 'Fourth Year';
        $year->save();

        $section = new \LIS\Section();
        $section->code = '-1';
        $section->name = 'Section 1';
        $section->save();

        $user = new User();
        $user->name = 'Jennifer Sanchez';
        $user->email = 'js@lis.com';
        $user->password = bcrypt('12345678');
        $user->save();

        $student_course = new \LIS\StudentSection();
        $student_course->course_id = 1;
        $student_course->year_id = 4;
        $student_course->section_id = 1;
        $student_course->save();

        $student = new \LIS\StudentInfo();
        $student->student_number = '2015-00216-CM-0';
        $student->first_name = 'Alfredo';
        $student->last_name = 'Illazar';
        $student->middle_name = 'R.';
        $student->course_section_id = 1;
        $student->save();

        $student = new \LIS\StudentInfo();
        $student->student_number = '2015-00202-CM-0';
        $student->first_name = 'Jennifer';
        $student->last_name = 'Sanchez';
        $student->middle_name = 'T.';
        $student->course_section_id = 1;
        $student->save();

        $student = new \LIS\StudentInfo();
        $student->student_number = '2015-00065-CM-0';
        $student->first_name = 'Joshua Miguel';
        $student->last_name = 'Magtibay';
        $student->middle_name = 'P.';
        $student->course_section_id = 1;
        $student->save();

        $book = new \LIS\BookInfo();
        $book->title = 'Book Sample #1';
        $book->copyright = date('Y-m-d', strtotime('2018'));
        $book->edition = 'First Edition';
        $book->publisher_id = 1;
        $book->class_id = 1;
        $book->save();

        $book_author = new BookAuthor();
        $book_author->book_id = 1;
        $book_author->author_id = 1;
        $book_author->save();

        $book_author = new BookAuthor();
        $book_author->book_id = 1;
        $book_author->author_id = 2;
        $book_author->save();

        $book_genre = new BookGenre();
        $book_genre->book_id = 1;
        $book_genre->genre_id = 4;
        $book_genre->save();

        $book_genre = new BookGenre();
        $book_genre->book_id = 1;
        $book_genre->genre_id = 6;
        $book_genre->save();

        $book_genre = new BookSubject();
        $book_genre->book_id = 1;
        $book_genre->subject_id = 1;
        $book_genre->save();

        $book_genre = new BookSubject();
        $book_genre->book_id = 1;
        $book_genre->subject_id = 2;
        $book_genre->save();

        $acquisition_type = new \LIS\AcquisitionType();
        $acquisition_type->code = 'dnt';
        $acquisition_type->name = 'Donation';
        $acquisition_type->save();

        $acquisition_type = new \LIS\AcquisitionType();
        $acquisition_type->code = 'stamesa';
        $acquisition_type->name = 'From Main Campus, Sta. Mesa';
        $acquisition_type->save();

        $acquisition_info = new \LIS\AcquisitionInfo();
        $acquisition_info->book_id = 1;
        $acquisition_info->acquisition_type_id = 2;
        $acquisition_info->quantity = 3;
        $acquisition_info->date_acquired = date('Y-m-d', strtotime(\Carbon\Carbon::now()));
        $acquisition_info->save();

        $shelf = new \LIS\LibraryShelf();
        $shelf->code = 'THS';
        $shelf->name = 'Theses';
        $shelf->save();

        $shelf = new \LIS\LibraryShelf();
        $shelf->code = 'FIL';
        $shelf->name = 'Filipiniana';
        $shelf->save();

        $shelf = new \LIS\LibraryShelf();
        $shelf->code = 'CIR';
        $shelf->name = 'Circulation';
        $shelf->save();

        $shelf = new \LIS\LibraryShelf();
        $shelf->code = 'COM';
        $shelf->name = 'Computer';
        $shelf->save();

        $book_status = new \LIS\BookInventoryStatus();
        $book_status->code = 'gcndtn';
        $book_status->name = 'Good Condition';
        $book_status->save();

        $book_status = new \LIS\BookInventoryStatus();
        $book_status->code = 'dmgd';
        $book_status->name = 'Damaged';
        $book_status->save();

        $book_status = new \LIS\BookInventoryStatus();
        $book_status->code = 'sbjctdspsl';
        $book_status->name = 'Subject for Disposal';
        $book_status->save();

        $book_status = new \LIS\BookInventoryStatus();
        $book_status->code = 'dspsd';
        $book_status->name = 'Disposed';
        $book_status->save();

        $book_status = new \LIS\BookInventoryStatus();
        $book_status->code = 'mssng';
        $book_status->name = 'Missing';
        $book_status->save();

        $book_status = new \LIS\BookInventoryStatus();
        $book_status->code = 'cndmnd';
        $book_status->name = 'Condemned';
        $book_status->save();

        $book_status = new \LIS\BookInventoryStatus();
        $book_status->code = 'wdng';
        $book_status->name = 'Weeding';
        $book_status->save();

        $section = new \LIS\ShelfSections();
        $section->prefix = 'FIL';
        $section->name = 'Filipiniana';
        $section->save();
    }
}
