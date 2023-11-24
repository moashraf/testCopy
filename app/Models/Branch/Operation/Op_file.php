<?php

namespace App\Models\Branch\Operation;

use App\Models\Branch\Airline_ticket;
use App\Models\Branch\Transp_ticket;
use App\Models\Branch\Trip_booking;
use App\Models\Branch\Unit_booking;
use App\Models\Branch\Visa_booking;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Op_file extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'status', //0- in progress, 1- done
        'code',
        'name',
        'worker_id',
        'date',
        'end_date',
        'note',
    ];

    public $timestamps = false;

    public function worker()
    {
        return $this->belongsTo(User::class, 'worker_id', 'id');
    }

    public function unit()
    {
        return $this->hasMany(Unit_booking::class, 'file_id', 'id');
    }

    public function trip()
    {
        return $this->hasMany(Trip_booking::class, 'file_id', 'id');
    }

    public function airline()
    {
        return $this->hasMany(Airline_ticket::class, 'file_id', 'id');
    }

    public function visa()
    {
        return $this->hasMany(Visa_booking::class, 'file_id', 'id');
    }

    public function transp()
    {
        return $this->hasMany(Transp_ticket::class, 'file_id', 'id');
    }
}