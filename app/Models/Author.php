<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{

    public function country()
    {
        return $this->hasOne(Country::class, 'country_id');
    }
}
