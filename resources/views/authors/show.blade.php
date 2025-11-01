<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Сторінка автора') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-4">

                    <h1 class="text-2xl font-bold">{{ $author->name }}</h1>
                    <div class="mt-2">
                        <h3 class="font-bold">Біографія:</h3>
                        <p class="text-gray-600">{{ $author->bio }}</p>
                    </div>

                    <hr class="my-6">

                    <h2 class="text-xl font-bold">Книги цього автора:</h2>
                    <div class="space-y-3 mt-4">
                        @forelse ($author->books as $book)
                            <div class="pb-2 border-b">
                                <h4 class="text-lg font-semibold">
                                    <a href="{{ route('books.show', $book) }}" class="hover:underline">
                                        {{ $book->title }}
                                    </a>
                                </h4>
                            </div>
                        @empty
                            <p>У цього автора ще немає доданих книг.</p>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>