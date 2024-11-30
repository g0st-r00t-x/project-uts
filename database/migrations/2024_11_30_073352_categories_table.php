<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // Kolom ID sebagai primary key
            $table->string('name'); // Nama kategori
            $table->text('description')->nullable(); // Deskripsi kategori
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories'); // Menghapus tabel saat rollback
    }
};
