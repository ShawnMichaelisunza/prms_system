<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('purchase_request_id');
            $table->text('deliver_to');
            $table->text('trade');
            $table->text('payment_mode');
            $table->string('payee');
            $table->string('remarks');
            $table->integer('ship_fee');
            $table->integer('other_cost');
            $table->integer('discount');
            $table->integer('total_price');
            $table->text('po_status')->default('PENDING');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
