<?php

namespace App\Models\Cat\Room;

use App\Models\Invoice\Debtor;
use App\Models\location\Country;
use App\Models\Patient\Patient;
use App\Models\Patient\Destination;
use App\Models\Patient\Wishlist;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Meal_cat extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
    ];

    public $timestamps = false;
}