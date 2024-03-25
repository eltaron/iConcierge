<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'inqiry_id',
        'content',
        'image',
        'record',
    ];
    protected $appends = [
        'time_ago'
    ];
    public function getTimeAgoAttribute()
    {
        return $this->created_at->diffForHumans();
    }
    public function inqiry()
    {
        return $this->belongsTo('App\Models\Inqiry');
    }
}
