<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionAmountsTable extends Migration
{
    public function up()
    {
        Schema::create('subscription_amounts', function (Blueprint $table) {
            $table->increments('id');
       
            $table->integer('uid')->unsigned()->nullable();
             $table->string('status',255)->nullable();
             $table->string('subscription_type',255)->nullable();
            $table->integer('amount')->nullable();
            $table->string('country',255)->nullable();
            
            $table->string('amount_in_paisa',255)->nullable();
            
            $table->tinyInteger('flag')->default(0);
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('subscription_amounts');
    }
}
