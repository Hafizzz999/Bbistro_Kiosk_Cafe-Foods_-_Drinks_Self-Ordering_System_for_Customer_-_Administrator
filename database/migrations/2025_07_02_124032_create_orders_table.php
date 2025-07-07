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
            $table->id();
            $table->enum('dining_method', ['Eat In', 'Take Away']);
            $table->foreignId('dining_table_id')->nullable()->constrained('dining_tables')->onDelete('set null');
            $table->decimal('total_price', 8, 2);
            $table->string('payment_method'); // Cash, QR Pay, etc.
            $table->enum('status', ['Pending', 'Completed', 'Cancelled'])->default('Pending');
            $table->timestamps();
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
