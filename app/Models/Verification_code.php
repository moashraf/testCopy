<?php

namespace App\Models;

use App\Models\Patient\Patient;
use App\Models\School\Manager;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verification_code extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'type', //1- register, 2- login, 3- forget password	
        'manager_id',
        'phone_number',
        'otp',
        'token',
        'expire_at',
        'verified', //verified = 1
    ];


    // relationship seller
    public function manager()
    {
        return $this->belongsTo(Manager::class, 'manager_id', 'id');
    }
}
