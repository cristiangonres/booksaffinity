<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookManageController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\EditorialController;
use App\Models\Book;
use App\Models\Country;

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



Route::get('/', [RoutingController::class, 'home']);
Route::get('/home', [RoutingController::class, 'home']);

Route::get('/books', [BookController::class, 'books']);
Route::get('/booksbyyear/{year}', [BookController::class, 'booksbyyears']);
Route::get('/book/{id}', [BookController::class, 'bookdetail']);

Route::post('/afterSignup', [UserController::class, 'signUp']);
Route::post('/home', [UserController::class, 'signIn']);

Route::get('/genres', [GenreController::class, 'showAllGenres']);
Route::get('/genre/{id}', [GenreController::class, 'showOneGenre']);

Route::get('/countries', [CountryController::class, 'countries']);
Route::get('/countrybook/{id}', [CountryController::class, 'booksByCountry']);
Route::get('/countryauthor/{id}', [CountryController::class, 'authorsByCountry']);


Route::get('/authors', [AuthorController::class, 'showAllAuthors']);
Route::get('/author/{id}', [AuthorController::class, 'showOneAuthor']);
Route::get('/authormanage',  [AuthorController::class, 'showAllAuthorsWithOptions']);
Route::get('/authormanage/insertar',  function(){
    return view('authorinsert');
});
Route::get('/authormanage/{id}',  [AuthorController::class, 'showOneAuthorsWithOptions']);
Route::post('/afterEditAuthor', [AuthorController::class, 'updateORdeleteAutor']);
Route::post('/afterSubmitAuthor', [AuthorController::class, 'submitAuthor']);

Route::get('/bookmanage', [BookManageController::class, 'emptyRet']);
Route::post('/bookmanage', [BookManageController::class, 'insert']);

Route::get('/filteredlist', [RoutingController::class, 'filterBooks']);
Route::post('/filteredlist', [RoutingController::class, 'filterBooks']);


Route::get('/book', [RoutingController::class, 'book']);

Route::get('/editorials', [EditorialController::class, 'editorial']);

Route::get('/editorialmanage', [EditorialController::class, 'editorialManage']);
Route::get('/editorialmanage/{id}', [EditorialController::class, 'editorialEdit']);
Route::get('/editorial/insertar',  function(){
    return view('editorialInsert');
});
Route::post('/afterEditEditorial', [EditorialController::class, 'updateOrDeleteEditorial']);
Route::post('/afterSubmitEditorial', [EditorialController::class, 'submitEditorial']);

Route::get('/editorial', function () {
    return view('editorial');
});

Route::get('/signup', function () {
    return view('signup2');
});

Route::get('/signin', function () {
    return view('signin');
});

Route::post('/afterEditUser', [UserController::class, 'editORdeleteUser']);

/*Route::get('/moderatexx', function () {
    return view('moderatexx');
});*/

/*
Route::get('/', [RoutingController::class, 'home']);
Route::get('/home', [RoutingController::class, 'home']);

Route::get('/author', [RoutingController::class, 'author']);
Route::get('/authormanage', [¿RoutingController?::class, 'authormanage']);

Route::get('/book', [RoutingController::class, 'book']);
Route::get('/bookmanage', [¿RoutingController?::class, 'bookmanage']);

Route::get('/editorial', [RoutingController::class, 'editorial']);
Route::get('/editorialmanage', [¿RoutingController?::class, 'editorialmanage']);

Route::get('/filteredlist', [RoutingController::class, 'filteredlist']);

Route::get('/moderatexx', [RoutingController::class, 'moderatexx']);

Route::get('/signup', [RoutingController::class, 'signup']);


*/
