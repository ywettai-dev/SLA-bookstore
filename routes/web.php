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

Route::get('/', 'PublicController@index')->name('public');
Route::get('/all/books', 'PublicController@allBook')->name('all.books');
Route::get('/all/ebooks', 'PublicController@allEbook')->name('all.ebooks');

Auth::routes();

//Book Management
Route::resource('books', 'BookController');
Route::get('detail/admin/{id}', 'BookController@detailAdmin');
Route::get('detail/{id}', 'BookController@detail');
//Book Search by searchbox
Route::post('search', 'BookController@search');

//Book Search by categories
Route::get('searchCat', 'SearchByCatController@searchCatindex');
Route::get('author/{id}/{name}', 'SearchByCatController@authorCat');
Route::get('genre/{id}/{name}', 'SearchByCatController@genreCat');
Route::get('publisher/{id}/{name}', 'SearchByCatController@publisherCat');

//Book Info
Route::resource('authors', 'AuthorController');
Route::resource('genres', 'GenreController');
Route::resource('publishers', 'PublisherController');
Route::resource('shelves', 'ShelfController');
Route::resource('shares', 'ShareController');

//Ebook Management
Route::resource('ebooks', 'EbookController');
Route::get('detail/admin/ebook/{id}', 'EbookController@detailAdmin');
Route::get('detail/ebook/{id}', 'EbookController@detail');

//Ebook Download
Route::get('download/{id}', 'EbookController@download_pdf');

//Book Issues
Route::resource('issues', 'IssueController');

//Book PDF report
Route::get('/dynamic_pdf/pdf', 'DynamicPDFController@pdf');
Route::get('/dynamic_pdf/pdfBook', 'DynamicPDFController@pdfBook');
Route::get('/dynamic_pdf/pdfEbook', 'DynamicPDFController@pdfEbook');

//Student
Route::resource('students', 'StudentController');

//Approval
Route::middleware(['auth'])->group(function (){
    Route::get('/approval','HomeController@approval')->name('approval');

    Route::middleware(['approved'])->group(function (){
        Route::get('/home', 'HomeController@index')->name('home');
    });

    Route::middleware(['admin'])->group(function (){
        Route::get('/users', 'UserController@index')->name('admin.users.index');
        Route::get('/users/{user_id}/approve', 'UserController@approve')->name('admin.users.approve');
    });
});


