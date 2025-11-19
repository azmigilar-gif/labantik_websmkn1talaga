@extends('layouts.app')

@section('title', $core->name)

@section('content')
    <div class="container mx-auto px-4 py-32">
        <div class="mx-auto max-w-3xl">
            <h1 class="mb-4 text-2xl font-bold">{{ $core->name }}</h1>
            <p class="mb-6 text-sm text-slate-600">{{ $core->slug }}</p>

            <div class="prose">
                @if ($s && $s->description)
                    {!! nl2br(e($s->description)) !!}
                @else
                    <p class="text-slate-500">Deskripsi belum tersedia untuk jurusan ini.</p>
                @endif
            </div>

            <div class="mt-6">

                <a href="{{ url()->previous() }}"
                    class="dark:bg-zink-700 inline-flex items-center gap-2 rounded border border-slate-500 bg-white px-4 py-2 text-slate-500 hover:border-slate-600 hover:bg-slate-600 hover:text-white focus:border-slate-600 focus:bg-slate-600 focus:text-white focus:ring focus:ring-slate-100 active:border-slate-600 active:bg-slate-600 active:text-white active:ring active:ring-slate-100 dark:ring-slate-400/20 dark:hover:bg-slate-500 dark:focus:bg-slate-500">
                    <i data-lucide="arrow-left" class="h-4 w-4"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </div>
    </div>
@endsection
