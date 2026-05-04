<aside class="space-y-12">
    {{-- カテゴリーセクション --}}
    <section>
        <h3 class="text-xl font-bold border-b-2 border-gray-800 mb-4 pb-2">Categories</h3>
        <ul class="space-y-2">
            @foreach($sideCategories as $cat)
                <li>
                    <a href="{{ route('posts.category', $cat->slug) }}" class="text-gray-600 hover:text-blue-600 transition flex justify-between items-center">
                        <span>{{ $cat->name }}</span>
                        <span class="text-sm text-gray-400">({{ $cat->posts_count }})</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </section>

    {{-- アーカイブセクション --}}
    <section>
        <h3 class="text-xl font-bold border-b-2 border-gray-800 mb-4 pb-2">Archives</h3>
        <ul class="space-y-2">
            @foreach($monthList as $month)
                @php
                    // "2026-05" を "2026" と "05" に分解してリンクに使う
                    [$year, $m] = explode('-', $month->year_month);
                @endphp
                <li>
                    <a href="{{ route('posts.archive', ['year' => $year, 'month' => $m]) }}" class="text-gray-600 hover:text-blue-600 transition flex justify-between items-center">
                        <span>{{ $year }}年{{ $m }}月</span>
                        <span class="text-sm text-gray-400">({{ $month->post_count }})</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </section>
</aside>