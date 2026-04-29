<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WallApp extends Model
{
    protected $fillable = [
        'name',
        'url',
        'icon',
        'description',
    ];
}
