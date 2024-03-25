<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'permissions',
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
}
