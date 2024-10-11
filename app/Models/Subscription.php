<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $table = 'subscriptions';

    protected $fillable = [
        'uid', 'type', 'status', 'plan', 'trial_start', 'trial_end', 
        'trial_signature', 'trial_razorpay_order_id', 'paid_subscription_start', 
        'paid_subscription_end', 'amount_id', 'payment_id', 'transaction_id', 
        'trial_renewal', 'paid_renewal', 'mail_flag', 'company_id'
    ];

    protected $casts = [
        'trial_start' => 'date',
        'trial_end' => 'date',
        'paid_subscription_start' => 'date',
        'paid_subscription_end' => 'date',
        'mail_flag' => 'boolean',
    ];
}
