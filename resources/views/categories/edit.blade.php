<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            カテゴリー編集
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <form method="post" action="{{ route('categories.update', $category) }}" class="space-y-6">
                    @csrf
                    @method('PATCH') 
                    <div>
                        <x-input-label for="name" value="カテゴリー名" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $category->name)" required />
                    </div>

                    <div>
                        <x-input-label for="slug" value="スラッグ" />
                        <x-text-input id="slug" name="slug" type="text" class="mt-1 block w-full" :value="old('slug', $category->slug)" required />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>更新</x-primary-button>
                        <a href="{{ route('categories.index') }}" class="text-sm text-gray-600">キャンセル</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>