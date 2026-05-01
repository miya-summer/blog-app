<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        @if (session('status'))
            <div 
                x-data="{ show: true }" 
                x-show="show" 
                x-init="setTimeout(() => show = false, 3000)"
                class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg transition-opacity duration-1000"
            >
                {{ session('status') }}
            </div>
        @endif
    </div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('カテゴリー管理') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">カテゴリー登録</h2>
                        <p class="mt-1 text-sm text-gray-600">新しいカテゴリーを追加します。</p>
                    </header>

                    <form method="post" action="{{ route('admin.categories.store') }}" class="mt-6 space-y-6">
                        @csrf
                        <div>
                            <x-input-label for="name" value="カテゴリー名" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus />
                        </div>

                        <div>
                            <x-input-label for="slug" value="スラッグ（URL用）" />
                            <x-text-input id="slug" name="slug" type="text" class="mt-1 block w-full" required />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('保存') }}</x-primary-button>
                        </div>
                    </form>
                </section>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <header class="mb-6">
                    <h2 class="text-lg font-medium text-gray-900">登録済みカテゴリー</h2>
                </header>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2 px-4">ID</th>
                            <th class="py-2 px-4">カテゴリー名</th>
                            <th class="py-2 px-4">スラッグ</th>
                            <th class="py-2 px-4">作成日</th>
                            <th class="py-2 px-4">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-2 px-4">{{ $category->id }}</td>
                                <td class="py-2 px-4">{{ $category->name }}</td>
                                <td class="py-2 px-4">{{ $category->slug }}</td>
                                <td class="py-2 px-4">{{ $category->created_at->format('Y-m-d') }}</td>
                                <td class="py-2 px-4 flex items-center gap-4">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="text-indigo-600 hover:text-indigo-900 text-sm">
                                        編集
                                    </a>

                                    <x-danger-button
                                        x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-category-deletion-{{ $category->id }}')"
                                    >
                                        削除
                                    </x-danger-button>

                                    <x-modal name="confirm-category-deletion-{{ $category->id }}" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                        <form method="post" action="{{ route('admin.categories.destroy', $category) }}" class="p-6">
                                            @csrf
                                            @method('delete')

                                            <h2 class="text-lg font-medium text-gray-900">
                                                「{{ $category->name }}」を削除してもよろしいですか？
                                            </h2>

                                            <p class="mt-1 text-sm text-gray-600">
                                                一度削除すると、このカテゴリーに関連付けられたデータも影響を受ける可能性があります。
                                            </p>

                                            <div class="mt-6 flex justify-end">
                                                <x-secondary-button x-on:click="$dispatch('close')">
                                                    キャンセル
                                                </x-secondary-button>

                                                <x-danger-button class="ms-3">
                                                    カテゴリーを削除する
                                                </x-danger-button>
                                            </div>
                                        </form>
                                    </x-modal>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-gray-500">カテゴリーはまだ登録されていません。</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>