<x-front-layout>
    {{-- 必要に応じてタイトルなどをスロットで渡すこともできます --}}
    {{-- ここでタイトルを定義！ --}}
    <x-slot name="title">
        {{ $post->title }} | みやさまブログ
    </x-slot>

    <div class="max-w-3xl mx-auto py-12 px-4">
        <article>
            <h1 class="text-4xl font-bold mb-4">{{ $post->title }}</h1>
            <p class="text-gray-500 mb-8">公開日: {{ $post->created_at->format('Y/m/d') }}</p>
            
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
            
            <div class="prose max-w-none text-lg leading-relaxed">
                {!! nl2br(e($post->body)) !!}
            </div>
        </article>

        <div class="mt-12">
            <a href="{{ route('home') }}" class="text-blue-600 hover:underline">
                ← 一覧に戻る
            </a>
        </div>
    </div>
</x-front-layout>