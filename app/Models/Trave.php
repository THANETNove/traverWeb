<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trave extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'history_tourist',
        'video',
        'gps',
        'opening_closing_time',
        'category'
    ];
}