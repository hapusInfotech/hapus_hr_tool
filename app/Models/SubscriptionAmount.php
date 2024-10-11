<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionAmount extends Model
{
    use HasFactory;
    protected $table = 'subscription_amounts';

    protected $fillable = [
        'subscription_id',

        'uid',
        'subscription_type',
        'amount',
        'flag',
        'amount_in_paisa',
    ];

}
