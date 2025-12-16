import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, router } from '@inertiajs/react'; // Додали router
import { useState } from 'react'; // Додали useState для інпуту

export default function Index({ auth, books, filters }) {
    // Стан для рядка пошуку (беремо початкове значення з filters, якщо воно є)
    const [searchTerm, setSearchTerm] = useState(filters.search || '');

    // Функція для запуску пошуку/фільтрації
    // Ми передаємо об'єкт params, наприклад: { genre_id: 5 }
    const handleFilter = (params) => {
        router.get(route('books.index'), params, {
            preserveState: true, // Щоб сторінка не блимала
            preserveScroll: true, // Щоб не кидало вгору сторінки
            replace: true, // Щоб не засмічувати історію браузера
        });
    };

    // Обробка пошуку по Enter
    const handleSearchSubmit = (e) => {
        e.preventDefault();
        handleFilter({ search: searchTerm });
    };

    // Скидання всіх фільтрів
    const clearFilters = () => {
        setSearchTerm('');
        router.get(route('books.index'));
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Бібліотека</h2>}
        >
            <Head title="Книги" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    
                    {/* --- БЛОК ПОШУКУ ТА ФІЛЬТРІВ --- */}
                    <div className="bg-white p-4 mb-6 shadow-sm sm:rounded-lg flex gap-4 items-center">
                        <form onSubmit={handleSearchSubmit} className="flex-1 flex gap-2">
                            <input 
                                type="text"
                                className="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                                placeholder="Пошук за назвою..."
                                value={searchTerm}
                                onChange={(e) => setSearchTerm(e.target.value)}
                            />
                            <button type="submit" className="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition">
                                Знайти
                            </button>
                        </form>

                        {/* Кнопка скидання фільтрів з'являється, якщо ми щось шукаємо */}
                        {(filters.search || filters.author_id || filters.publisher_id || filters.genre_id) && (
                            <button onClick={clearFilters} className="text-red-500 hover:text-red-700 underline">
                                Скинути фільтри
                            </button>
                        )}
                    </div>

                    {/* --- СПИСОК КНИГ --- */}
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        {books.length === 0 ? (
                            <p className="text-center text-gray-500">Книг за вашим запитом не знайдено.</p>
                        ) : (
                            <div className="grid gap-6">
                                {books.map((book) => (
                                    <div key={book.id} className="p-4 border rounded-lg hover:shadow-md transition bg-gray-50">
                                        <div className="flex justify-between items-start">
                                            <h3 className="text-xl font-bold text-gray-800">{book.title}</h3>
                                            
                                            {/* Жанри як кнопки */}
                                            <div className="flex gap-1">
                                                {book.genres.map(genre => (
                                                    <button 
                                                        key={genre.id} 
                                                        onClick={() => handleFilter({ genre_id: genre.id })}
                                                        className={`text-xs px-2 py-1 rounded-full border transition 
                                                            ${filters.genre_id == genre.id ? 'bg-indigo-600 text-white border-indigo-600' : 'bg-white text-indigo-600 border-indigo-200 hover:bg-indigo-50'}
                                                        `}
                                                    >
                                                        {genre.name}
                                                    </button>
                                                ))}
                                            </div>
                                        </div>
                                        
                                        <div className="mt-2 text-sm text-gray-700 space-y-1">
                                            <p>
                                                <span className="font-semibold">Автор: </span> 
                                                <button 
                                                    onClick={() => handleFilter({ author_id: book.author.id })}
                                                    className="text-indigo-600 hover:underline hover:text-indigo-800"
                                                >
                                                    {book.author.name} {book.author.surname}
                                                </button>
                                            </p>
                                            
                                            <p>
                                                <span className="font-semibold">Видавництво: </span> 
                                                {book.publisher ? (
                                                    <button 
                                                        onClick={() => handleFilter({ publisher_id: book.publisher.id })}
                                                        className="text-indigo-600 hover:underline hover:text-indigo-800"
                                                    >
                                                        {book.publisher.name}
                                                    </button>
                                                ) : 'Не вказано'}
                                            </p>
                                        </div>

                                        <p className="mt-3 text-gray-600 italic text-sm">{book.description}</p>
                                    </div>
                                ))}
                            </div>
                        )}
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}