<?php

namespace App\Models\Branch;

use App\Models\Invoice\Debtor;
use App\Models\location\Country;
use App\Models\Patient\Patient;
use App\Models\Patient\Destination;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'slug',
        'info',
        'description',
        'img',
        'show_hp_top',
        'color',
    ];

    public $timestamps = false;

    // relationship image
    public function imgs()
    {
        return $this->hasMany(Tag_image::class, 'tag_id', 'id');
    }
}