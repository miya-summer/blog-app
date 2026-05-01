<!-- resources/views/posts/edit.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            記事編集
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <form action="{{ route('admin.posts.update', $post) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PATCH') {{-- 更新時はPATCHメソッドを使う --}}

                    <div>
                        <x-input-label for="title" value="タイトル" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $post->title)" required />
                    </div>

                    <div>
                        <x-input-label for="body" value="本文" />
                        <textarea id="body" name="body" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="5" required>{{ old('body', $post->body) }}</textarea>
                    </div>

                    <div>
                        <x-input-label value="カテゴリ（複数選択OK）" />
                        <div class="mt-2 flex flex-wrap gap-4">
                            @foreach($categories as $category)
                                <div class="flex items-center">
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}" id="category_{{ $category->id }}" 
                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                        {{-- 記事がこのカテゴリを持っているか判定してチェックを入れる --}}
                                        @if($post->categories->contains($category->id)) checked @endif
                                    >
                                    <label for="category_{{ $category->id }}" class="ml-2 text-sm text-gray-600">{{ $category->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>更新する</x-primary-button>
                        <a href="{{ route('admin.posts.index') }}" class="text-sm text-gray-600 underline">キャンセル</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>