<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function authors()
    {
        return $this->belongsToMany(Author::class)->withPivot('book_id');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class)->withPivot('book_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}

