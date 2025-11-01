<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $book->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-4">

                    <h1 class="text-2xl font-bold">{{ $book->title }}</h1>

                    <p class="text-lg text-gray-700">
                        Автор: 
                        <a href="{{ route('authors.show', $book->author) }}" class="text-blue-600 hover:underline">
                            {{ $book->author->name }}
                        </a>
                    </p>

                    <div class="mt-4">
                        <h3 class="font-bold">Опис:</h3>
                        <p class="text-gray-600">{{ $book->description }}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>