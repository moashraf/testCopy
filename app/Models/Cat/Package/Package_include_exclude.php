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

class Package_include_exclude extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'type', //1- include, 2-exclude	
        'package_id',
        'include_exclude_cat_id',
    ];

    public $timestamps = false;


    public function include_exclude()
    {
        return $this->belongsTo(Include_exclude_cat::class, 'include_exclude_cat_id', 'id');
    }
}