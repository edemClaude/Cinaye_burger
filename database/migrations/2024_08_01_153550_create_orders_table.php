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
            $table->foreignId('customer_id')->constrained()
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('burger_id')->constrained()
                ->onDelete('cascade')->onUpdate('cascade');
            $table->integer('quantity')->default(1);
            $table->string('facture')->nullable();
            $table->enum('status', ['pending', 'canceled', 'sold'])->default('pending');
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
