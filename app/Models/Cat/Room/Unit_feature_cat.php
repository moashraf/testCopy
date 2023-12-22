<?php

namespace App\Models\Cat\Room;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit_feature_cat extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'icon',
    ];

    public $timestamps = false;
}