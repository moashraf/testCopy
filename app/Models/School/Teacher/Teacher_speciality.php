<?php

namespace App\Models\School\Teacher;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher_speciality extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'name',
    ];
}