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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('merchant_id'); // Relasi ke merchant
            $table->string('name'); // Nama menu
            $table->text('description'); // Deskripsi menu
            $table->string('photo'); // Foto menu
            $table->decimal('price', 10, 2); // Harga menu
            $table->timestamps();

            // Foreign key untuk relasi ke merchant
            $table->foreign('merchant_id')->references('id')->on('merchants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
