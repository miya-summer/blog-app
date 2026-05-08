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
            
            {{-- 修正後：HTMLとしてレンダリングさせる --}}
            {{--
                prose-table:w-auto : テーブルの幅を内容に合わせて自動調整 
                prose-table:border-collapse : テーブルの枠線をくっつける
                prose-th:border prose-td:border : 各セルに枠線を引く
                prose-th:bg-gray-100 : ヘッダーに薄いグレーを敷く
            --}}
            <div class="overflow-x-auto">
                <div class="prose max-w-none prose-table:w-auto prose-table:border-collapse prose-th:border prose-td:border prose-th:bg-gray-100 prose-th:px-4 prose-th:py-2 prose-td:px-4 prose-td:py-2">
                    {!! $post->body_html !!}
                </div>
            </div>
        </article>

        <div class="mt-12">
            <a href="{{ route('home') }}" class="text-blue-600 hover:underline">
                ← 一覧に戻る
            </a>
        </div>
    </div>
</x-front-layout>