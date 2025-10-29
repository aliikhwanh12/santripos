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
        Schema::create('deposit', function (Blueprint $table) {
            $table->id();
            $table->string('cust_ID');
            $table->string('Nama');
            $table->date('Dateencoded');
            $table->string('Receiver');
            $table->decimal('Saldo_Awal');
            $table->decimal('Top_Up');
            $table->decimal('Saldo_Akhir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposit');
    }
};
