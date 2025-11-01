<?php

namespace Database\Seeders;


use App\Models\Book;
use App\Models\Author;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);
    // Оскільки наша BookFactory також створює Author::factory(),
    // цей один рядок автоматично створить 50 книг
    // і необхідну кількість авторів для них (або 50, або менше).
    Book::factory(50)->create();
    }
}
