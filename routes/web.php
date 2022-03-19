<?php

use Illuminate\Support\Facades\Route;
use App\Models\Book;

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
    return view('home');
});


Route::get('/testdb', function () {
    $books = Book::all();
    foreach($books as $book){
        echo $book->title . " - " . $book->publi_date . "<br>";
    }

});
Route::get('/home', function () {
    return view('home');
});

Route::get('/author', function () {
    return view('author');
});

Route::get('/authormanage', function () {
    return view('authormanage');
});

Route::get('/book', function () {
    return view('book');
});

Route::get('/bookmanage', function () {
    return view('bookmanage');
});

Route::get('/editorial', function () {
    return view('editorial');
});

Route::get('/editorialmanage', function () {
    return view('editorialmanage');
});

Route::get('/filteredlist', function () {
    return view('filteredlist');
});

Route::get('/moderatexx', function () {
    return view('moderatexx');
});

Route::get('/signup', function () {
    return view('signup');
});

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
