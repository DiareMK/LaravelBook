<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Каталог Книг') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="space-y-4">
                        @forelse ($books as $book)
                            <div class="p-4 border-b">
                                <h3 class="text-lg font-bold">
                                    <a href="{{ route('books.show', $book) }}" class="hover:underline">
                                        {{ $book->title }}
                                    </a>
                                </h3>
                                <p class="text-sm text-gray-600">
                                    Автор: 
                                    <a href="{{ route('authors.show', $book->author) }}" class="text-blue-600 hover:underline">
                                        {{ $book->author->name }}
                                    </a>
                                </p>
                            </div>
                        @empty
                            <p>Наразі книг у бібліотеці немає.</p>
                        @endforelse
                    </div>

                    <div class="mt-6">
                        {{ $books->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>