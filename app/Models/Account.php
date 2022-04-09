<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public $timestamps = false;

    public function books()
    {
        return $this->belongsToMany(Book::class)->withPivot('account_id', 'book_id', 'rate')->using(AccountBook::class);
    }

    public function authors()
    {
        return $this->belongsToMany(Book::class)->withPivot('account_id', 'author_id', 'rate')->using(AccountAuthor::class);;
    }
}
