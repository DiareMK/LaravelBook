<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Inertia\Inertia; // Це "міст" між Laravel та React
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        // Починаємо будувати запит
        $query = Book::with(['author', 'publisher', 'genres']);

        // 1. Пошук по назві книги (якщо є параметр 'search')
        $query->when($request->input('search'), function ($q, $search) {
            $q->where('title', 'like', "%{$search}%");
        });

        // 2. Фільтр по Автору (якщо клікнули на автора)
        $query->when($request->input('author_id'), function ($q, $id) {
            $q->where('author_id', $id);
        });

        // 3. Фільтр по Видавництву
        $query->when($request->input('publisher_id'), function ($q, $id) {
            $q->where('publisher_id', $id);
        });

        // 4. Фільтр по Жанру (тут трохи складніше, бо зв'язок Many-to-Many)
        $query->when($request->input('genre_id'), function ($q, $id) {
            $q->whereHas('genres', function ($query) use ($id) {
                $query->where('genres.id', $id);
            });
        });

        // Отримуємо результат
        $books = $query->get();

        return Inertia::render('Books/Index', [
            'books' => $books,
            // Повертаємо поточні фільтри назад на фронтенд, щоб підсвітити їх або заповнити пошук
            'filters' => $request->only(['search', 'author_id', 'publisher_id', 'genre_id'])
        ]);
    }
}