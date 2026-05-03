<x-front-layout>
    {{-- ここに書いた内容が、front.blade.php の {{ $slot }} の部分に表示されます --}}
    <x-slot name="title">
        最新記事一覧 | みやさまブログ
    </x-slot>
    
    <div class="max-w-7xl mx-auto py-8 px-4">
        <h2 class="text-2xl font-bold mb-6">記事一覧</h2>

        <div class="grid gap-6">
            @foreach ($posts as $post)
                <article class="p-6 bg-white shadow rounded-lg">
                    <h3 class="text-xl font-semibold">
                        <a href="{{ route('posts.show', $post) }}" class="hover:text-blue-600">
                            {{ $post->title }}
                        </a>
                    </h3>
                    {{-- 記事に関連付けられた全てのカテゴリを表示 --}}
                    <div class="flex flex-wrap gap-2 mb-6">
                        @forelse($post->categories as $category)
                            <span class="bg-gray-200 text-gray-700 px-2 py-1 rounded text-sm">
                                {{ $category->name }}
                            </span>
                        @empty
                            <span class="text-gray-400 text-sm">カテゴリなし</span>
                        @endforelse
                    </div>
                    <p class="text-gray-600 mt-2">
                        {{ Str::limit($post->content, 100) }}
                    </p>
                    <div class="mt-4 text-sm text-gray-500">
                        {{ $post->created_at->format('Y.m.d') }}
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</x-front-layout>