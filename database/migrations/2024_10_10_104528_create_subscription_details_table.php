<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('subscription_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('subscription_id');     
            $table->foreign('subscription_id')->references('id')->on('subscriptions')->onDelete('cascade'); 
            $table->integer('uid')->unsigned()->nullable();
            $table->string('name', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->text('address')->nullable();
            $table->string('country', 255)->nullable();
            $table->string('payment_status', 255)->nullable();
            $table->tinyInteger('flag')->default(0);
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('subscription_details');
    }
}

