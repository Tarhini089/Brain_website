<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    // protected $table = 'country'; // Important: your table is singular

    protected $fillable = ['name', 'is_inactive'];
}
