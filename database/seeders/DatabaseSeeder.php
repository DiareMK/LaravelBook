<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Publisher;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Створюємо юзера для тесту
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // 2. Створюємо 5 видавництв
        $publishers = Publisher::factory(5)->create();

        // 3. Створюємо 10 жанрів
        $genres = Genre::factory(10)->create();

        // 4. Створюємо 10 авторів
        $authors = Author::factory(10)->create();

        // 5. Створюємо книги і прив'язуємо їх до авторів, видавництв та жанрів
        foreach ($authors as $author) {
            // Кожен автор напише 3 книги
            $books = Book::factory(3)->create([
                'author_id' => $author->id,
                'publisher_id' => $publishers->random()->id, // Випадкове видавництво
            ]);

            // Для кожної книги беремо 2 випадкові жанри
            foreach ($books as $book) {
                $book->genres()->attach($genres->random(2));
            }
        }
    }
}