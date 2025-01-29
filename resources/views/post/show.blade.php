<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">


                    <div style="border: 1px solid {{ $post->color }}; padding: 10px; margin: 10px;">
                        <h2>{{ $post->title }}</h2>
                        <p><strong>Author:</strong> {{ $post->author }}</p>
                        <p><strong>Content:</strong> {{ $post->content }}</p>
                        <p><strong>ID:</strong> {{ $post->id }}</p>
                        <p><strong>Color:</strong> {{ $post->color }}</p>
                    </div>

                    <a href="/post"> Go back </a>

                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
