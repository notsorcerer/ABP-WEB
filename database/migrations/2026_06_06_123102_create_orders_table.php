<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('order_number')->unique();
            $table->string('shipping_name');
            $table->string('shipping_country')->default('Indonesia');
            $table->string('shipping_province');
            $table->string('shipping_city');
            $table->string('shipping_district');
            $table->string('shipping_postal_code');
            $table->text('shipping_address');
            $table->string('shipping_phone');
            $table->string('shipping_email');
            $table->string('payment_method');
            $table->string('payment_status')->default('pending');
            $table->decimal('total', 12, 2);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
