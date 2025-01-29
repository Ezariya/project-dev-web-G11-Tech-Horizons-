@foreach($chats as $chat)
    <li class="p-4 bg-white dark:bg-gray-700 rounded-md shadow">
        <p class="text-sm text-gray-700 dark:text-gray-300">
            <strong>{{ $chat->user->name }}:</strong> {{ $chat->message }}
        </p>
        <p class="text-xs text-gray-500 dark:text-gray-400">
            {{ $chat->created_at->diffForHumans() }}
        </p>
    </li>
@endforeach
