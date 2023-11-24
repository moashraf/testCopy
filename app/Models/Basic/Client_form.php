<?php

namespace App\Models\Basic;

use App\Models\Invoice\Debtor;
use App\Models\location\Country;
use App\Models\Patient\Patient;
use App\Models\Patient\Destination;
use App\Models\Patient\Wishlist;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Client_form extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'code',
        'phone_number',
        'email',
        'from_destination_id',
        'to_destination_id',
        'from_date',
        'to_date',
        'subject',
        'content',
        'status',
        'worker_id',
    ];


    public function from_destination()
    {
        return $this->belongsTo(Destination::class, 'from_destination_id', 'id')->withDefault([
            'name' => 'Not Selected',
        ]);
    }


    public function to_destination()
    {
        return $this->belongsTo(Destination::class, 'to_destination_id', 'id')->withDefault([
            'name' => 'Not Selected',
        ]);
    }


    public function worker()
    {
        return $this->belongsTo(User::class, 'worker_id', 'id')->withDefault([
            'full_name' => 'Not Selected',
        ]);;
    }
}
