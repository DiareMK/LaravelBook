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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Назва книги
            $table->text('description')->nullable(); // Опис книги

        // Створюємо поле для зв'язку з таблицею 'authors'
            $table->foreignId('author_id')
              ->constrained('authors') // Вказує, що це ключ до таблиці 'authors'
              ->onDelete('cascade'); // Якщо видаляємо автора, видаляємо і його книги
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
