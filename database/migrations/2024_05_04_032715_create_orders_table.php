<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('identifier')->unique();

            $table->foreignUlid('product_id')->references('id')->on('products');
            $table->foreignUlid('customer_id')->references('id')->on('users');
            $table->enum('order_status',['Order_Placed', 'Processing', 'Shipped', 'Delivered', 'Cancelled'])->default('Order_Placed');
            $table->enum('payment_type',['card', 'cash','bank_transfer','cash_on_delivery']);

            $table->string('email');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address');
            $table->string('city');
            $table->string('country');
            $table->string('state');
            $table->string('post_code');
            $table->string('phone_number', 36);

            $table->decimal('product_amount')->default(0.00);
            $table->integer('quantity')->default(0);
            $table->decimal('shipping_amount')->default(0.00);

            $table->decimal('total_gross_amount')->default(0.00);
            $table->decimal('total_net_amount')->default(0.00);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
