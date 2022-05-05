<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Editorial extends Model
{
    public $timestamps = false;
    
    use HasFactory;

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
