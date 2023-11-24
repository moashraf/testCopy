<?php

namespace App\Models\Branch;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class On_request_item extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'on_request_id',
        'patient_id',
        'name',
        'cat',
        'meal',
        'img',
        'capacity',
        'status',
        'type', //like hotel,trip, package
        'cat',
        'from_destination_id',
        'to_destination_id',
        'start_at',
        'end_at',
        'requestable_id',
        'requestable_type',  //like App\Models\Patient\Session_pat
        'price_id', //offer_room_price_id
        'qty',
        'subtotal',
        'discount',
        'final_price',
        'buy',
    ];

    public $timestamps = false;


    public function on_request()
    {
        return $this->belongsTo(on_request::class, 'on_request_id', 'id');
    }

    public function requestable()
    {
        return $this->morphTo();
    }
}