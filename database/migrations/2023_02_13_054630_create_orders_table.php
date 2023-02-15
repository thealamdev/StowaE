<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('order_status')->default('processing')->comment('processing','complete','cancel');
            $table->string('payment_status')->default('unpaid')->comment('unpaid','paid');
            $table->string('coupon_name')->nullable();
            $table->integer('coupon_amount')->nullable();
            $table->integer('shipping_charge')->nullable();
            $table->string('order_note')->nullable();
            $table->string('transaction_id')->nullable();
            $table->decimal('total');
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
        Schema::dropIfExists('orders');
    }
};
