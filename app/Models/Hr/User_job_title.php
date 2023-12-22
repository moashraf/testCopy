<?php

namespace App\Models\Hr;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User_job_title extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'name',
    ];

    public $timestamps = false;
}
