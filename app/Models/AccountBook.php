<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AccountBook extends Pivot
{
    public $timestamps = false;
    use HasFactory;

}
