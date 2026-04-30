<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            記事一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @forelse($posts as $post)
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <h3 class="text-2xl font-bold text-gray-900">{{ $post->title }}</h3>
                    
                    <div class="mt-2 flex gap-2">
                        @foreach($post->categories as $category)
                            <span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full font-bold">
                                {{ $category->name }}
                            </span>
                        @endforeach
                    </div>

                    <div class="mt-4 text-gray-600">
                        {!! nl2br(e($post->body)) !!}
                    </div>
                    
                    <div class="mt-2 text-sm text-gray-400 text-right">
                        {{ $post->created_at->format('Y/m/d H:i') }}
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500">記事がまだありません。</p>
            @endforelse
        </div>
    </div>
</x-app-layout>