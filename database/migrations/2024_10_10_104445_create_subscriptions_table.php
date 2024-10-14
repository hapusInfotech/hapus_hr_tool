<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->increments('id'); // Primary key, auto-incremented

            $table->integer('type')->unsigned()->nullable();
            $table->integer('uid')->unsigned()->notNullable();
            $table->string('status', 50)->notNullable();
            $table->timestamps();
            $table->string('plan')->nullable();
            $table->date('trial_start')->nullable(); 
            $table->date('trial_end')->nullable();
            $table->string('trial_signature')->nullable();
            $table->string('trial_razorpay_order_id')->nullable();
            $table->date('paid_subscription_start')->nullable(); // Date when paid subscription starts
            $table->date('paid_subscription_end')->nullable();
            $table->string('amount_id',255)->nullable();
            $table->string('amount',255)->nullable();
            $table->tinyInteger('trial_renewal')->nullable();
            $table->tinyInteger('paid_renewal')->nullable();
            $table->string('payment_id',255)->nullable();
            $table->string('transaction_id',255)->nullable();
            $table->tinyInteger('mail_flag')->default(0);
            $table->integer('company_id')->unsigned()->nullable();
          
        });
    }

    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}
