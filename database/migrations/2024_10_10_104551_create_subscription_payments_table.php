<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionPaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('subscription_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('subscription_id');     
            $table->foreign('subscription_id')->references('id')->on('subscriptions')->onDelete('cascade'); 
           
            $table->integer('uid')->unsigned()->nullable();
            $table->string('payment_type', 255)->nullable();
            $table->string('transaction_id',255)->nullable();
            $table->string('status', 255)->nullable();
            $table->integer('amount_id')->nullable();
            $table->string('payment_gateway', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('subscription_payments');
    }
}
