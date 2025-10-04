<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type');
            $table->string('author_id');
            $table->timestamps();

            $table->foreignId('author_id')->constrained('authors')->onDelete('restrict');
            // Нельзя удалить автора, пока у него есть книги
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
