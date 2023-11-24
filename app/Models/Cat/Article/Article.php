<?php

namespace App\Models\Cat\Article;

use App\Models\Branch\Item_tag;
use App\Models\Branch\Trip;
use App\Models\Branch\Unit;
use App\Models\location\Country;
use App\Models\Patient\Destination;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'main_img',
        'name',
        'slug',
        'short_description',
        'description',
    ];


    // relationship image
    public function imgs()
    {
        return $this->hasMany(Article_image::class, 'article_id', 'id');
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destination_id', 'id')->withDefault([
            'name' => 'Not Selected',
        ]);
    }

    public function tags()
    {
        return $this->hasMany(Article_tag::class, 'article_id', 'id');
    }
}
