<?php

namespace App\Models\Patient;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Password_reset extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'email',
        'token',
    ];

    public function company()
    {
        return $this->belongsTo(Manager::class, 'patient_id', 'id');
    }
}
