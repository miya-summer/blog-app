<?php

namespace App\Services;

use Spatie\LaravelMarkdown\MarkdownRenderer;

class MarkdownService
{
    public function convert(string $markdown): string
    {
        // 1. app() でパッケージを呼び出す
        // 2. メソッドチェーンで「こだわり」を注入する
        // 3. 最後に toHtml() で変換を実行する
        return app(MarkdownRenderer::class)
            ->highlightTheme('github-dark')
            ->commonmarkOptions([
                'html_input' => 'strip',
                'allow_unsafe_links' => false,
            ])
            ->toHtml($markdown);
    }
}