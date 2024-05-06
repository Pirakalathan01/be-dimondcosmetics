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
        Schema::create('products', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('code')->unique();
            $table->string('name');
            $table->foreignUlid('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->text('description');
            $table->text('directions');
            $table->decimal('price')->default(0.00);
            $table->integer('in_stock')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
