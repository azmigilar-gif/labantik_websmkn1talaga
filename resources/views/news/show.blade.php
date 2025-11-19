@extends('layouts.app')

@section('title', $news->title ?? 'Berita')

@section('content')

    <section class="py-32">
        <div class="container mx-auto px-4 2xl:max-w-[87.5rem]">
            <div class="mx-auto xl:max-w-3xl">
                <div class="mb-4 text-sm text-slate-500">
                    @if ($news->category || $news->categories)
                        <span class="rounded bg-sky-100 px-2 py-1 text-sky-600">
                            {{ $news->category->name ?? ($news->categories->name ?? 'Tanpa Kategori') }}
                        </span>
                    @endif
                    <span class="ml-2">{{ $news->created_at->format('d M Y') }} ·
                        {{ $news->created_at->diffForHumans() }} · {{ $news->createdBy?->name ?? '-' }}</span>
                </div>

                <h1 class="dark:text-zink-100 mb-6 text-3xl font-bold text-slate-800">{{ $news->title }}</h1>

                @php
                    $firstImg = null;
                if (isset($news->content) && preg_match('/<img.+@endphp/i', $news->content, $matches)) {
    $firstImg = $matches[0];

    // Sanitize extracted <img> so inline width/height/style don't break layout
    libxml_use_internal_errors(true);
    $doc = new \DOMDocument();
    $doc->loadHTML(mb_convert_encoding($firstImg, 'HTML-ENTITIES', 'UTF-8'));
    $imgTag = $doc->getElementsByTagName('img')->item(0);
    if ($imgTag) {
        // remove width/height attributes
        $imgTag->removeAttribute('width');
        $imgTag->removeAttribute('height');

        // clean style attribute (remove width/height declarations)
        $style = $imgTag->getAttribute('style');
        $style = preg_replace('/(width|height)\s*:\s*[^;]+;?/i', '', $style);
        $style = trim($style);
        if ($style === '') {
            $imgTag->removeAttribute('style');
        } else {
            $imgTag->setAttribute('style', $style);
        }

        $firstImg = $doc->saveHTML($imgTag);
    }
    libxml_clear_errors();
}
?>

                <div class="prose dark:text-zink-200 max-w-none text-slate-700">
                    {!! $news->content !!}
                </div>

<div class="flex justify-end mt-4">
    <a href="{{ $backUrl ?? route('news.index') }}"
       class="inline-flex items-center gap-2 px-4 py-2 rounded border border-slate-500
              bg-white text-slate-500
              hover:bg-slate-600 hover:text-white hover:border-slate-600
              focus:bg-slate-600 focus:text-white focus:border-slate-600 focus:ring focus:ring-slate-100
              active:bg-slate-600 active:text-white active:border-slate-600 active:ring active:ring-slate-100
              dark:bg-zink-700 dark:hover:bg-slate-500 dark:ring-slate-400/20 dark:focus:bg-slate-500">
        <span>Berita Lainnya</span>
        <i data-lucide="arrow-right" class="w-4 h-4"></i>
    </a>
</div>
            </div>
        </div>
    </section>

@endsection
