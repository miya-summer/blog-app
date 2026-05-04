<x-front-layout>
    <x-slot name="title">
        {{ $title ?? '最新記事一覧' }} | みやさまブログ
    </x-slot>
    
    <div class="max-w-7xl mx-auto py-8 px-4">
        {{-- Gridコンテナ：PC(md以上)で12分割、ギャップ(隙間)を8空ける --}}
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
            
            {{-- メインエリア：8カラム分を使用 --}}
            <main class="md:col-span-8">
                @if(isset($title))
                    <h2 class="text-2xl font-bold mb-6 pb-2 border-b">{{ $title }}</h2>
                @else
                    <h2 class="text-2xl font-bold mb-6">最新記事一覧</h2>
                @endif

                <div class="grid gap-6">
                    @foreach ($posts as $post)
                        <article class="p-6 bg-white shadow rounded-lg">
                            <h3 class="text-xl font-semibold">
                                <a href="{{ route('posts.show', $post) }}" class="hover:text-blue-600">
                                    {{ $post->title }}
                                </a>
                            </h3>
                            
                            <div class="flex flex-wrap gap-2 mt-2 mb-4">
                                @forelse($post->categories as $category)
                                    <span class="bg-gray-200 text-gray-700 px-2 py-1 rounded text-sm">
                                        {{ $category->name }}
                                    </span>
                                @empty
                                    <span class="text-gray-400 text-sm">カテゴリなし</span>
                                @endforelse
                            </div>

                            <p class="text-gray-600">
                                {{ Str::limit($post->content, 100) }}
                            </p>
                            
                            <div class="mt-4 text-sm text-gray-500">
                                {{ $post->created_at->format('Y.m.d') }}
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $posts->links() }}
                </div>
            </main>

            {{-- サイドバーエリア：4カラム分を使用 --}}
            <aside class="md:col-span-4">
                <x-sidebar />
            </aside>

        </div>
    </div>
</x-front-layout>