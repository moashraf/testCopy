<?php

namespace App\Models\Cat\Room;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit_feature extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'unit_id',
        'feature_id',
    ];

    public $timestamps = false;

    public function feature()
    {
        return $this->belongsTo(Unit_feature_cat::class, 'feature_id', 'id');
    }
}