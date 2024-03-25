<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'invoice_id',
        'invoice_status',
        'invoice_reference',
        'created_date',
        'comments',
        'payment_gateway',
        'invoice_display_value',
        'transaction_id',
        'transaction_status',
        'paid_currency',
        'paid_currency_value',
        'card_number',
        'is_success',
        'operation',
        'subscription_id',
        'booking_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function subscription()
    {
        return $this->belongsTo('App\Models\Subscription');
    }
}
