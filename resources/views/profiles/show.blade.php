@extends('layouts.app')

@section('title', 'Profil Sekolah')

@section('content')
    <section class="relative py-24 pb-16 xl:py-32 xl:pb-20">
        <div class="container mx-auto px-4">
            <!-- wider max width so content has more room, and allow long words to break -->
            <div class="mx-auto xl:max-w-5xl">
                <h1 class="mb-6 capitalize leading-normal">Profil Sekolah</h1>

                <div class="prose max-w-none whitespace-normal break-words text-slate-800 dark:text-zinc-200">
                    {!! $profile->content !!}
                </div>

                <div class="mt-6">
                    <a href="{{ url()->previous() }}"
                        class="text-custom-500 border-custom-500 hover:bg-custom-50 inline-flex items-center gap-2 rounded border px-4 py-2 text-sm font-medium">Kembali</a>
                </div>
            </div>
        </div>
    </section>
@endsection
