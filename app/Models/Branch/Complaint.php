<?php

namespace App\Models\Branch;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'appointment_id',
        'body',
        'answered',
        'status', //unsolved = 0 and solved = 1
    ];   


    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id', 'id');
    }


}