<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionDetail extends Model
{
    use HasFactory;
    protected $table = 'subscription_details';

    protected $fillable = [
        'subscription_id',
        'uid',
        'name',
        'phone',
        'address',
        'country',
        'payment_status',
        'flag',
    ];


}
