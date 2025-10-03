@extends('layouts.app')

@section('content')
    <div class="max-w-9xl mx-auto p-6">

        {{-- Club Info --}}
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-blue-600">{{ $club->name }}</h1>
            <p class="text-gray-600">{{ $club->description }}</p>
            <p class="text-sm text-gray-500 mt-1">
                📅 Founded: {{ $club->founded_date ?? 'N/A' }} |
                📂 Category: {{ $club->category ?? 'Uncategorized' }}
            </p>
        </div>

        {{-- Posts --}}
        <div class="mt-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">📢 Club Posts</h2>

            @if ($posts->count())
                @foreach ($posts as $post)
                    <div x-data="{ showComments: false }" class="mb-4 p-4 border border-gray-200 rounded shadow-sm bg-gray-50">

                        {{-- Post Info --}}
                        <h3 class="text-lg font-bold text-gray-800">{{ $post->title }}</h3>
                        <p class="text-gray-600 text-sm">
                            By {{ $post->author->name ?? 'Unknown' }} • {{ $post->created_at->diffForHumans() }}
                        </p>
                        <p class="mt-2 text-gray-700">{{ $post->content }}</p>

                        {{-- Comment Toggle Button --}}
                        <button @click="showComments = !showComments" class="mt-3 text-blue-600 hover:underline text-sm">
                            💬 Comments
                        </button>

                        {{-- Comments Section --}}
                        <div x-show="showComments" class="mt-5" x-cloak>
                            {{-- Existing Comments --}}
                            @if ($post->comments->count())
                                <div class="space-y-4">
                                    @foreach ($post->comments as $comment)
                                        <div class="flex items-start space-x-3 bg-white p-4 border border-gray-200 rounded-lg shadow-sm">
                                            <div class="flex-shrink-0">
                                                <div
                                                    class="w-10 h-10 bg-blue-100 text-blue-600 flex items-center justify-center rounded-full font-semibold uppercase">
                                                    {{ substr($comment->user->name ?? 'A', 0, 1) }}
                                                </div>
                                            </div>
                                            <div>
                                                <div class="flex items-center space-x-2">
                                                    <h4 class="font-semibold text-gray-800 text-sm">
                                                        {{ $comment->user->name ?? 'Anonymous' }}
                                                    </h4>
                                                    <span class="text-xs text-gray-400">
                                                        {{ $comment->created_at->diffForHumans() }}
                                                    </span>
                                                </div>
                                                <p class="text-gray-700 mt-1 text-sm leading-relaxed">
                                                    {{ $comment->body }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500 text-sm">No comments yet. Be the first to share your thoughts!</p>
                            @endif

                            {{-- Comment Form --}}
                            @auth
                                <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mt-6">
                                    @csrf
                                    <div class="flex space-x-3">
                                        <div class="flex-shrink-0">
                                            <div
                                                class="w-10 h-10 bg-green-100 text-green-600 flex items-center justify-center rounded-full font-semibold uppercase">
                                                {{ substr(auth()->user()->name, 0, 1) }}
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <textarea name="body" rows="2"
                                                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm"
                                                placeholder="Write a comment..." required></textarea>
                                            <div class="mt-2 text-right">
                                                <button type="submit"
                                                    class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 text-sm font-medium shadow-sm transition">
                                                    ➤ Post Comment
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <p class="text-sm text-gray-600 mt-4">
                                    <a href="{{ route('login') }}" class="text-blue-600 underline">Login</a> to join the discussion.
                                </p>
                            @endauth
                        </div>

                    </div>
                @endforeach
            @else
                <p class="text-gray-500">No posts yet in this club.</p>
            @endif

            {{-- Create Post Button --}}
            @if(auth()->user()->isEntrepreneurOf($club))
                <div class="mt-4">
                    <a href="{{ route('posts.create', $club->id) }}"
                        class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                        ➕ Create Post
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection