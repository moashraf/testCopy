<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker_record extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id',
        'doctor_id',
        'type',
        'amount',
        'start',
        'note',
    ];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id', 'id');
    }

}