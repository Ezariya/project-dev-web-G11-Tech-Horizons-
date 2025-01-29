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
                    <h1> Posts list </h1>


                    {{-- <form action="{{ route('post.store2') }}" method="POST"> --}}
                    <form action="/post/update/{{ $post->id }}" method="POST">
                        @csrf
                        <div>
                            <label for="title">Title:</label>
                            <input type="text" id="title" name="title" value="{{ $post->title }}" required>
                        </div>
                
                        <div>
                            <label for="author">Author:</label>
                            <input type="text" id="author" name="author" value="{{ $post->author }}" required>
                        </div>
                
                        <div>
                            <label for="content">Content:</label>
                            <textarea id="content" name="content" rows="5" required>{{ $post->content }}</textarea>
                        </div>
                
                        <div>
                            <label for="color">Color (optional):</label>
                            <input type="text" id="color" name="color" value="{{ $post->color }}">
                        </div>
                
                        <div>
                            <button type="submit">Update Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
