<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prox_setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'option_name',
        'option_value',
    ];
    
    public $timestamps = false;

}