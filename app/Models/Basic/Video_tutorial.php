<?php

namespace App\Models\Basic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video_tutorial extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'type', //1- first slide in hp
        'url',
    ];

    public $timestamps = false;
}