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
        Schema::table('order_items', function (Blueprint $table) {
            $table->decimal('delivery_charge', 8, 2)->after('price');
            $table->decimal('earn_price', 8, 2)->after('delivery_charge');
            $table->string('order_status')->default('pending')->after('earn_price');
            $table->unsignedBigInteger('delivery_men_id')->nullable();
            $table->string('currency');
            $table->string('payment_method');
            $table->boolean('delivery_option');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn(['delivery_charge', 'earn_price', 'order_status', 'delivery_men_id']);
        });
    }
};
