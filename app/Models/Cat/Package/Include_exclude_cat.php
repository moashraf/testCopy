<?php

namespace App\Models\Cat\Package;

use App\Models\Invoice\Debtor;
use App\Models\location\Country;
use App\Models\Patient\Patient;
use App\Models\Patient\Destination;
use App\Models\Patient\Wishlist;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Include_exclude_cat extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'type', //1- include, 2-exclude	
        'name',
    ];

    public $timestamps = false;
}