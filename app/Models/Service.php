<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'location',
        'map',
        'popular',
        'price'
    ];
    protected $appends = [
        'time_ago'
    ];
    public function getTimeAgoAttribute()
    {
        return $this->created_at->diffForHumans();
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function images()
    {
        return $this->hasMany('App\Models\Image');
    }
    public function details()
    {
        return $this->hasMany('App\Models\ServiceDetail');
    }
    public function image()
    {
        return $this->hasOne('App\Models\Image');
    }
}
