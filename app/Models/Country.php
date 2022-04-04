<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function books()
    {
        return $this->hasMany(Book::class, 'country_id');
    }
}

