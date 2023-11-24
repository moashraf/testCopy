<?php

namespace App\Models\location;

use App\Models\Branch\Order;
use App\Models\Patient\Service_item;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'fav',
    ];

    public $timestamps = false;

    public function unit()
    {
        return $this->hasMany(Unit::class, 'country_id', 'id')->withTrashed();
    }

    public function service_item()
    {
        return $this->hasMany(Service_item::class, 'country_id', 'id');
    }

    public function trip()
    {
        return $this->hasMany(Trip::class, 'country_id', 'id')->withTrashed();
    }

    public function order()
    {
        return $this->hasMany(Order::class, 'country_id', 'id');
    }
}
