<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('bookings')->onDelete('cascade');
            $table->string('checkout_request_id')->nullable();
            $table->string('merchant_request_id')->nullable();
            $table->string('mpesa_receipt_number')->nullable();
            $table->string('phone_number');
            $table->decimal('amount', 10, 2);
            $table->string('status')->default('pending'); // pending, completed, failed
            $table->string('result_code')->nullable();
            $table->string('result_description')->nullable();
            $table->timestamp('transaction_date')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
