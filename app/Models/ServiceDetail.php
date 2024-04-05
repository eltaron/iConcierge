<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_id',
        'key',
        'value'
    ];
    protected $appends = [
        'time_ago'
    ];
    public function getTimeAgoAttribute()
    {
        return $this->created_at->diffForHumans();
    }
    public function service()
    {
        return $this->belongsTo('App\Models\Service');
    }
    public function image()
    {
        return $this->hasOne('App\Models\Image', 'service_detail', 'id');
    }
    public function images()
    {
        return $this->hasMany('App\Models\Image', 'service_detail', 'id');
    }
}
