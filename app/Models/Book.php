<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public $timestamps = false;
    public function authors()
    {
        return $this->belongsToMany(Author::class)->withPivot('book_id');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class)->withPivot('book_id', 'genre_id')->using(BookGenre::class);
    }

    public function accounts()
    {
        return $this->belongsToMany(Account::class)->withPivot('book_id', 'account_id', 'rate', 'review', 'title_review', 'date_review' )->using(AccountBook::class);
    }

    public function reviews()
    {
        return $this->belongsToMany(Account::class)->withPivot('book_id', 'account_id', 'review', 'title_review')->using(AccountBook::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}

