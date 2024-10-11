<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPayment extends Model
{
    use HasFactory;
    protected $table = 'subscription_payments';

    protected $fillable = [
        'subscription_id',
        'uid',
        'payment_type',
        'transaction_id',
        'status',
        'amount_id',
        'payment_gateway',
    ];


}
