<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('shops_id')->unsigned();
            $table->foreign('shops_id')->references('id')->on('shops');
            $table->mediumText('group_name')->nullable();
            $table->integer('subscription_type')->default(0);
            $table->longText('product_ids')->nullable();
            $table->longText('recurring_filter')->nullable();
            $table->integer('interval_type')->default(0);
            $table->integer('max_number')->default(0);
            $table->integer('frequency_num')->default(0);
            $table->integer('frequency_type')->default(0);
            $table->integer('billing_plan')->default(0);
            $table->integer('billing_day')->default(0);
            $table->integer('billing_offset')->default(0);
            $table->integer('billing_offset_week')->default(0);
            $table->integer('is_subscription_default_on_widget')->default(0);
            $table->integer('is_limited_subscription')->default(0);
            $table->integer('limited_length')->default(0);
            $table->integer('limited_continue')->default(0);
            $table->integer('prepaid_limited_length')->default(0);
            $table->integer('prepaid_discount')->default(0);
            $table->integer('prepaid_continue')->default(0);
            $table->integer('min_convertible_cancel_length_enabled')->default(0);
            $table->integer('min_recurrences_before_cancellable')->default(0);
            $table->mediumText('discount_config')->nullable();
            $table->decimal('discount', 10, 2)->default(0);
            $table->integer('box_lock_days')->default(0);
            $table->integer('box_lock_hours')->default(0);
            $table->integer('box_lock_after_choices')->default(0);
            $table->integer('box_lock_beyond_days')->default(0);
            $table->mediumText('search_title')->nullable();
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
        Schema::dropIfExists('subscription_plans');
    }
}
