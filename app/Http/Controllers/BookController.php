<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Account;
use App\Models\AccountBook;
use Illuminate\Support\Facades\DB;


class BookController extends Controller
{
    function books(){

        $books = Book::query()
        ->with(['authors'])
        ->when(request('search'), function ($query) {
            return $query->where('title', 'like', '%' . request ('search') . '%')
                ->orWhereHas('authors', function ($q) {
                    $q->where('author_name', 'like', '%' . request ('search') . '%');
                });
        }) ->orderBy('title', 'asc')->get();

        return view('books', compact('books'));

    }

    function bookdetail($id){
        $book=Book::where('id', $id)
        ->get();
        $users=Account::all();

        $nrate = count($book["0"]["accounts"]);
        $ncoments=0;
        for ($i = 0; $i < $nrate; $i++) {

            if($book["0"]["accounts"][$i]['pivot']['date_review'] != ""){
                $ncoments += 1;
            }
        }

        $userData = array();

        for ($i = 0; $i < $ncoments; $i++) {

            foreach($users as $user){

                if($user->id ==$book["0"]["accounts"][$i]['pivot']['account_id'] ){
                    $userData[$i]["username"] = $user->username;
                    $accountRates=AccountBook::where('account_id', $user->id)->get();
                    $rates=0;
                    $comments=0;
                    foreach($accountRates as $accountRate){
                        if($accountRate->rate !=""){
                            $rates ++;
                        }
                        if($accountRate->date_review !=""){
                            $comments ++;
                        }

                    }
                    $userData[$i]["rates"] = $rates;
                    $userData[$i]["coments"] = $comments;

                }
            }
            $userData[$i]["user_id"] = $book["0"]["accounts"][$i]['pivot']['account_id'];
            $userData[$i]["rate"] = $book["0"]["accounts"][$i]['pivot']['rate'];
            $userData[$i]["date_review"] =$book["0"]["accounts"][$i]['pivot']['date_review'];
            $userData[$i]["title_review"] = $book["0"]["accounts"][$i]['pivot']['title_review'];
            $userData[$i]["review"] = $book["0"]["accounts"][$i]['pivot']['review'];
        }


        return view('bookdetail', compact('book', 'userData'));
    }

    function booksbyyears($year){
        $books=Book::whereYear('publi_date', $year)
        ->get();
        return view('booksbyyear', compact('books'));
    }

    function addComment($idBook, Request $request){
        session_start();

        $findComment = AccountBook::where('account_id', $_SESSION['user_id'])
        ->where('book_id', $idBook)
        ->first();

        if($findComment!=''){

            $findComment->account_id = $_SESSION["user_id"];
            $findComment->book_id = $idBook;
            $findComment->rate = $request->get("rate");
            $findComment->title_review= $request->get("title");
            $findComment->review = $request->get("comment");
            $findComment->date_review = date('Y-m-d');
            $findComment->save();

        }else{

        $newComment=new AccountBook();
        $newComment->account_id = $_SESSION["user_id"];
        $newComment->book_id = $idBook;
        $newComment->rate = $request->get("rate");
        $newComment->title_review= $request->get("title");
        $newComment->review = $request->get("comment");
        $newComment->date_review = date('Y-m-d');
        $newComment->save();
        }


        $bc = new BookController();
        $bcDetail = $bc->bookdetail($idBook);

        return $bcDetail;
    }

}
