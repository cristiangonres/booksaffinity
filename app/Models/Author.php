<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public function books()
    {
        return $this->belongsToMany(Book::class)->withPivot('author_id');
    }

    public function country()
    {
        return $this->hasOne(Country::class, 'id');
    }

    public function accounts()
    {
        return $this->belongsToMany(Account::class)->withPivot('author_id', 'account_id', 'rate')->using(AccountAuthor::class);
    }
}
