<?php

namespace App\Models\Cat\Article;

use App\Models\Branch\Trip;
use App\Models\Branch\Unit;
use App\Models\location\Country;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article_tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'tag_id',
        'article_id',
    ];

    public $timestamps = false;
}
