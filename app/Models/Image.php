<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        'url',
        'filename',
        'service_id',
    ];
    public function service()
    {
        return $this->belongsTo('App\Models\Service');
    }
}
