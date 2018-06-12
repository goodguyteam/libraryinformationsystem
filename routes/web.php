<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/redirect', function () {
    return redirect(route('dashboard'))->with('login', 'Welcome '.Auth::user()->name.', you logged in successfully');
})->name('redirect');

Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::resource('/site-configuration', 'SiteConfigurationCRUDController');
Route::resource('/business-hours', 'BusinessHoursCRUDController');
Route::resource('/identity-management', 'IdentityManagementCRUDController');
Route::resource('/student-management', 'StudentInfosCRUDController');
Route::resource('/student-sections', 'StudentSectionsCRUDController');
Route::resource('/courses', 'CoursesCRUDController');
Route::resource('/sections', 'SectionCRUDController');
Route::resource('/years', 'YearCRUDController');
Route::resource('/authors', 'AuthorsCRUDController');
Route::resource('/publishers', 'PublisherCRUDController');
Route::resource('/genres', 'GenresCRUDController');
Route::resource('/subjects', 'SubjectsCRUDController');
Route::resource('/editions', 'EditionsCRUDController');
Route::resource('/book-infos', 'BookInfosCRUDController');
Route::resource('/acquisition-infos', 'AcquisitionInfosCRUDController');
Route::resource('/book-inventories', 'BookInventoriesCRUDController');
Route::resource('/classifications', 'ClassificationsCRUDController');
Route::resource('/library-shelves', 'LibraryShelvesCRUDController');
Route::resource('/shelf-sections', 'ShelfSectionsCRUDController');
Route::resource('/book-circulations', 'BookCirculationCRUDController');
Route::resource('/disposal-infos', 'DisposalCRUDController');
Route::get('/print', 'ReportsController@genres')->name('report.genre');
Route::get('/inventory-report', 'InventoryReportController@index')->name('report.inventory');
Route::get('/inventory-pdf', 'InventoryPDFController@index')->name('report.inventorypdf');
Route::get('/condemned-report', 'CondemnedReportController@index')->name('report.condemned');
Route::get('/condemned-pdf', 'CondemnedPDFController@index')->name('report.condemnedpdf');
Route::get('/weeding-report', 'WeedingReportController@index')->name('report.weeding');
Route::get('/weeding-pdf', 'WeedingPDFController@index')->name('report.weedingpdf');
Route::get('/circulation-report', 'CirculationReportController@index')->name('report.circulation');
Route::get('/circulation-pdf', 'CirculationPDFController@index')->name('report.circulationpdf');
Route::get('/missing-report', 'MissingReportController@index')->name('report.missing');
Route::get('/missing-pdf', 'MissingPDFController@index')->name('report.missingpdf');
Route::post('/android-login', 'AndroidScannerController@login')->name('android.login');
Route::post('/android-logout', 'AndroidScannerController@logout')->name('android.logout');
Route::get('/android-picture', 'AndroidScannerController@picture')->name('android.picture');
Route::get('/android-current-logs', 'AndroidScannerController@logs')->name('android.currentlogs');
