<?php

namespace App\Models\School\Management;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Edu_department_office extends Model
{

    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'edu_department_id',
        'name',
    ];

    public function department()
    {
        return $this->belongsTo(Edu_department::class, 'edu_department_id', 'id');
    }
}
