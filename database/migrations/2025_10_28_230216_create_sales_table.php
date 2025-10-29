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
        Schema::create('sales', function (Blueprint $table) {
            $table->string('InvoiceNo')->primary();
            $table->string('Description', 255)->nullable();
            $table->decimal('NetPrice', 10, 2)->default(0);
            $table->decimal('UnitPrice', 10, 2)->default(0);
            $table->integer('Quantity')->default(0);
            $table->decimal('Subtotal', 10, 2)->default(0);
            $table->dateTime('DateEncoded')->nullable();         // waktu transaksi
            $table->string('EncodedBy', 100)->nullable();
            $table->string('CustomerCD', 50)->index();           // relasi ke customer
            $table->timestamps(); // created_at & updated_at Laravel
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
