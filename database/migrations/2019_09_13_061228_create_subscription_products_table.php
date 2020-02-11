<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('subscription_products', function (Blueprint $table) {
             $table->bigIncrements('id');
             $table->integer('subscription_plans_id')->default(0);
             
             $table->longText('product_id')->nullable();
             $table->longText('variants_id')->nullable();
             $table->integer('status')->default(0);
             $table->integer('sync_status')->default(0);
             $table->timestamp('sync_request_date');
             $table->dateTime('sync_date')->nullable();
             $table->softDeletes();
             $table->timestamps();
         });
     }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_products');
    }
}
