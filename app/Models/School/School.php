<?php

namespace App\Models\School;

use App\Models\School\Management\Edu_department;
use App\Models\School\Management\Edu_department_office;
use App\Models\School\Student\School_grade;
use App\Models\School\Student\School_grade_class;
use App\Models\School\Student\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class School extends Model
{

    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'new_id',
        'code',
        'first_second_school', //first school: 1, second school: 2
        'manager_id',
        'gendar', //1- male, 2-female
        'name',
        'level', //1- primary, 2-middle,3 high
        'ministerial_number',
        'school_type', //1- public, 2- privit
        'edu_department_id',
        'edu_department_office_id',
        'established_date',
        'school_period', //1- morning,2 afternoon, 3- night
        'has_entsab',
        'address',
        'telephone',
        'phone_number',
        'whatsapp',
        'twitter',
        'website',
        'facebook',
        'snapchat',
        'tiktok',
        'telegram',
        'building_type',
        'building_status',
        'classes_number',
        'bathroom_number',
        'floors_number',
        'teachers_room_number',
        'management_room_number',
        'computers_room_number',
        'lab_room_number',
        'stock_room_number',
        'learning_resources_room_number',
        'activities_room_number',
        'meetings_room_number',
        'sport_room_number',
        'theaters_number',
        'grounds_number',
        'outdoor_room_number',
        'indoor_room_number',
        'total_rooms',
    ];


    public function manager()
    {
        return $this->belongsTo(Manager::class, 'manager_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo(Edu_department::class, 'manager_id', 'id');
    }
    public function department_office()
    {
        return $this->belongsTo(Edu_department_office::class, 'edu_department_office_id', 'id');
    }

    public function grades()
    {
        return $this->hasMany(School_grade::class, 'school_id', 'id')->withTrashed();
    }

    public function classes()
    {
        return $this->hasMany(School_grade_class::class, 'school_id', 'id')->withTrashed();
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'school_id', 'id')->withTrashed();
    }

    public function teachers()
    {
        return $this->hasMany(Manager::class, 'belong_school_id', 'id')->where('type', 3)->withTrashed();
    }

    public function administrators()
    {
        return $this->hasMany(Manager::class, 'belong_school_id', 'id')->where('type', 2)->withTrashed();
    }
}
