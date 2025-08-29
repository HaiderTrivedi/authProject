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
        Schema::create('itsid_imports', function (Blueprint $table) {
            $table->id();
            $table->string('itsid')->unique();
            $table->string('status')->default('pending'); // e.g., pending, fetched, error
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itsid_imports');
    }
};
