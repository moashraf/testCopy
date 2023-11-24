<?php

namespace App\Models\School\Student;

use App\Models\School\Manager;
use App\Models\School\School;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class School_grade_class extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'manager_id',
        'school_id',
        'school_grade_id',
        'name',
        'is_entsab',
    ];

    public $timestamps = false;

    public function manager()
    {
        return $this->belongsTo(Manager::class, 'manager_id', 'id');
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }

    public function grade()
    {
        return $this->belongsTo(School_grade::class, 'school_grade_id', 'id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'school_grade_class_id', 'id')->withTrashed();
    }
}
