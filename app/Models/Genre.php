<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    public function books()
    {
        return $this->belongsToMany(Book::class)->withPivot('genre_id', 'book_id')->using(BookGenre::class);
    }
}
