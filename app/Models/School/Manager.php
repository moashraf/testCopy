<?php

namespace App\Models\School;

use App\Models\Branch\Airline_ticket;
use App\Models\Branch\Appointment;
use App\Models\Branch\Booking;
use App\Models\Branch\Branch;
use App\Models\Branch\Lab;
use App\Models\Branch\Operation;
use App\Models\Branch\Package_booking;
use App\Models\Branch\Transp_ticket;
use App\Models\Branch\Trip_booking;
use App\Models\Branch\Unit_booking;
use App\Models\Branch\Visa_booking;
use App\Models\Invoice\Acc_account;
use App\Models\Invoice\Debtor;
use App\Models\Invoice\Invoice;
use App\Models\Invoice\Payment;
use App\Models\Invoice\Wallet;
use App\Models\location\City;
use App\Models\location\Country;
use App\Models\location\Region;
use App\Models\Patient\From_recourse;
use App\Models\School\Student\School_grade;
use App\Models\School\Student\School_grade_class;
use App\Models\School\Student\Student;
use App\Models\School\Teacher\School_job;
use App\Models\School\Teacher\Teacher_speciality;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class Manager extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'new_id',
        'type', //1= managers, 2= Administrators, 3- teachers
        'belong_school_id',
        'belong_manager_id',
        'recommendation',
        'code',
        'roadmap', //1- choose school, 2- welcome, 3-general info sc1, 4- facilities sc1, 5- students sc1, 6- entsab sc1, 7- teachers sc1, 8- administrators sc1, 9- other info sc1, 10- general info sc2, 11- facilities sc2, 12- students sc2, 12- entsab sc2, 13- teachers sc2, 13- administrators sc2, 14- other info sc2, 15-done roadmap	
        'shared_school', //1- one school, 2- 2 schools
        'current_working_school_id', //the current working school in dashboard
        'first_school_id',
        'second_school_id',
        'email',
        'password',
        'first_name',
        'second_name',
        'inactive',
        'avatar',
        'religion',
        'birthday',
        'gendar',
        'country_id',
        'city_id',
        'phone_number',
        'sec_phone_number',
        'identification_number',
        'school_job_id',
        'teacher_speciality_id',
        'from_recourse_id',
        'note',
        'creator_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = ['full_name'];



    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id')->withDefault([
            'name' => 'Not Selected',
        ]);
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id')->withDefault([
            'name' => 'Not Selected',
        ]);
    }

    public function recourse()
    {
        return $this->belongsTo(From_recourse::class, 'from_recourse_id', 'id')->withTrashed();
    }


    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }


    public function first_school()
    {
        return $this->belongsTo(School::class, 'first_school_id', 'id')->withTrashed();
    }


    public function second_school()
    {
        return $this->belongsTo(School::class, 'second_school_id', 'id')->withTrashed();
    }

    public function teacher_speciality()
    {
        return $this->belongsTo(Teacher_speciality::class, 'teacher_speciality_id', 'id')->withTrashed();
    }

    public function job()
    {
        return $this->belongsTo(School_job::class, 'school_job_id', 'id')->withTrashed();
    }


    public function current_school()
    {
        return $this->belongsTo(School::class, 'current_working_school_id', 'id')->withTrashed();
    }

    // ------------- one to many relations -------------

    public function schools()
    {
        return $this->hasMany(School::class, 'manager_id', 'id')->withTrashed();
    }

    public function teachers()
    {
        return $this->hasMany(Manager::class, 'belong_manager_id', 'id')->where('type', 3)->withTrashed();
    }

    public function first_school_teachers()
    {
        return $this->hasMany(Manager::class, 'belong_manager_id', 'id')->where('type', 3)->where('belong_school_id', Auth::guard('school')->user()->first_school_id)->withTrashed();
    }

    public function second_school_teachers()
    {
        return $this->hasMany(Manager::class, 'belong_manager_id', 'id')->where('type', 3)->where('belong_school_id', Auth::guard('school')->user()->second_school_id)->withTrashed();
    }

    public function administrators()
    {
        return $this->hasMany(Manager::class, 'belong_manager_id', 'id')->where('type', 2)->withTrashed();
    }

    public function first_school_administrators()
    {
        return $this->hasMany(Manager::class, 'belong_manager_id', 'id')->where('type', 2)->where('belong_school_id', Auth::guard('school')->user()->first_school_id)->withTrashed();
    }

    public function second_school_administrators()
    {
        return $this->hasMany(Manager::class, 'belong_manager_id', 'id')->where('type', 2)->where('belong_school_id', Auth::guard('school')->user()->second_school_id)->withTrashed();
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'manager_id', 'id')->withTrashed();
    }

    public function first_school_students()
    {
        return $this->hasMany(Student::class, 'manager_id', 'id')->where('school_id', Auth::guard('school')->user()->first_school_id)->withTrashed();
    }


    public function second_school_students()
    {
        return $this->hasMany(Student::class, 'manager_id', 'id')->where('school_id', Auth::guard('school')->user()->second_school_id)->withTrashed();
    }

    public function first_school_grades()
    {
        return $this->hasMany(School_grade::class, 'manager_id', 'id')->where('school_id', Auth::guard('school')->user()->first_school_id)->withTrashed();
    }

    public function second_school_grades()
    {
        return $this->hasMany(School_grade::class, 'manager_id', 'id')->where('school_id', Auth::guard('school')->user()->second_school_id)->withTrashed();
    }

    public function first_school_classes()
    {
        return $this->hasMany(School_grade_class::class, 'manager_id', 'id')->where('school_id', Auth::guard('school')->user()->first_school_id)->withTrashed();
    }

    public function second_school_classes()
    {
        return $this->hasMany(School_grade_class::class, 'manager_id', 'id')->where('school_id', Auth::guard('school')->user()->second_school_id)->withTrashed();
    }

    public function invoices()
    {
        return $this->morphMany(Invoice::class, 'receivable');
    }

    public function Payments()
    {
        return $this->morphMany(Payment::class, 'receivable');
    }

    // --------------------

    //for full name
    public function getFullnameAttribute()
    {
        if (!$this->second_name) {
            $name = $this->first_name;
        } else {
            $name = $this->first_name . " " .   $this->second_name;
        }
        return $name;
    }

    public function age()
    {
        return Carbon::parse($this->attributes['birthday'])->age;
    }
}