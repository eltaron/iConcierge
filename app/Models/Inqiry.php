<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inqiry extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'service_id',
        'date_from',
        'date_to',
        'status',
        'contact_method',
        'name',
        'email',
        'phone',
        'interseted_services',
        'spetail_request',
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
    public function messages()
    {
        return $this->hasMany('App\Models\Message');
    }
    public function last_messages()
    {
        return $this->hasOne('App\Models\Message')->latest();
    }
}
