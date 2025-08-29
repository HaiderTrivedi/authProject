<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('receipt_no')->unique();
            $table->date('receipt_date');
            $table->string('name');
            $table->string('its_number');
            $table->foreignId('currency_id')->constrained();

            // Financial Contributions - using decimal for currency values
            $table->decimal('kh', 10, 2)->default(0);
            $table->decimal('nm', 10, 2)->default(0);
            $table->decimal('khms', 10, 2)->default(0);
            $table->decimal('si', 10, 2)->default(0);
            $table->decimal('mnt', 10, 2)->default(0);
            $table->decimal('nyz', 10, 2)->default(0);
            $table->decimal('nj', 10, 2)->default(0);
            $table->decimal('total_collection', 10, 2);

            $table->string('payment_mode'); // e.g., 'cash' or 'cheque'
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
