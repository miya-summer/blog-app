<x-front-layout>
    {{-- ここに書いた内容が、front.blade.php の {{ $slot }} の部分に表示されます --}}
    
    <div class="max-w-7xl mx-auto py-8 px-4">
        <h2 class="text-2xl font-bold mb-6">記事一覧</h2>

        <div class="grid gap-6">
            @foreach ($posts as $post)
                <article class="p-6 bg-white shadow rounded-lg">
                    <h3 class="text-xl font-semibold">
                        {{-- まだ詳細ページがなければ、とりあえずタイトルだけ --}}
                        {{ $post->title }}
                    </h3>
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