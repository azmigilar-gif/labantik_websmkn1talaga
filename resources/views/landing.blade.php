@extends('layouts.app')

@section('title', 'SMKN 1 Talaga')

@section('content')

    @php
        // prepare menus and find profile content for hero
        $profileMenu = $menus->firstWhere('slug', 'section-profil');
        $heroProfile = null;
        if ($profileMenu) {
            foreach ($profiles as $p) {
                if (!empty($p->menu) && $p->menu->id === $profileMenu->id) {
                    $heroProfile = $p;
                    break;
                }
            }
        }
    @endphp

    <section class="relative pb-28 pt-44 xl:pb-36 xl:pt-52" id="home" style="min-height:100vh;">
        <div class="bg-custom-500 absolute left-0 top-0 z-10 size-64 opacity-10 blur-3xl"></div>
        <div class="absolute bottom-0 right-0 z-10 size-64 bg-purple-500/10 blur-3xl"></div>
        @php
            // Prefer an uploaded background file saved to public/assets/images/background.*
            $heroImage = null;
            $foundAssetBackground = null;
            // glob will look for any extension (jpg, png, webp, etc.)
            $matches = @glob(public_path('assets/images/background.*')) ?: [];
            if (!empty($matches)) {
                // use the first match and build an assets-relative path
                $foundAssetBackground = 'assets/images/' . basename($matches[0]);
            }

            if ($foundAssetBackground) {
                $heroImage = $foundAssetBackground;
            } elseif (!empty($heroProfile->photo)) {
                $heroImage = $heroProfile->photo;
            } else {
                $heroImage = 'assets/images/background.png';
            }
            // If stored as full URL or assets path, build correct url
            if (filter_var($heroImage, FILTER_VALIDATE_URL)) {
                $heroImageUrl = $heroImage;
            } elseif (preg_match('#^assets/#', $heroImage) || preg_match('#^public/assets/#', $heroImage)) {
                $heroImageUrl = asset(preg_replace('#^public/#', '', $heroImage));
            } else {
                // treat as storage path
                $rel = preg_replace('#^storage/#', '', $heroImage);
                $heroImageUrl = route('public.files', ['path' => $rel]);
            }
        @endphp

        <!-- Full-bleed background layer (covers entire viewport width) -->
        <div class="hero-bleed absolute inset-0"
            style="background-image: url('{{ $heroImageUrl }}'); background-repeat:no-repeat; background-position: center right; background-size: cover; z-index:0; opacity:0.5;">
            <!-- optional overlay for contrast -->
        </div>
        <div class="container mx-auto px-4 2xl:max-w-[87.5rem]" style="position:relative; z-index:1;">
            <div class="grid grid-cols-12 items-center gap-5 2xl:grid-cols-12">

                <div class="col-span-12 xl:col-span-5 2xl:col-span-5">
                    <style>
                        .hero-bg {
                            background-repeat: no-repeat;
                            background-position: right center;
                            background-size: cover;
                            min-height: 100vh;
                            display: flex;
                            align-items: center;
                        }

                        /* Keep text at fixed sizes but constrain width so it doesn't stretch with viewport */
                        .hero-content {
                            max-width: 720px;
                            width: 100%;
                        }

                        @media (max-width: 1024px) {
                            .hero-bg {
                                /* move background toward center on medium/smaller screens */
                                background-position: center center;
                                background-size: cover;
                            }
                        }

                        @media (max-width: 480px) {
                            .hero-bg {
                                /* ensure background still covers on very small screens */
                                background-position: center top;
                                background-size: cover;
                                padding-top: 3.5rem;
                                padding-bottom: 3.5rem;
                            }
                        }
                    </style>

                    <div class="hero-bg rounded-lg bg-transparent p-6" style="background:transparent;">
                        <div class="hero-content">
                            <h1 class="mb-4 !leading-normal lg:text-5xl 2xl:text-6xl dark:text-zinc-100"
                                data-aos="fade-right" data-aos-delay="300"> Selamat Datang di Website Resmi SMKN 1 Talaga
                            </h1>
                            <p class="mb-7 text-lg dark:text-zinc-400" data-aos="fade-right" data-aos-delay="600"> SMKN 1
                                Talaga adalah Sekolah Menengah Kejuruan Negeri di Talaga, Majalengka, Jawa Barat yang
                                membekali siswa dengan keterampilan praktis.</p>
                            <div class="flex items-center gap-2" data-aos="fade-right" data-aos-delay="800">
                                <a href="#{{ $profileMenu->slug ?? 'section-profil' }}"
                                    class="text-15 btn from-custom-500 hover:to-custom-500 border-0 bg-gradient-to-r to-purple-500 px-8 py-3 text-white hover:from-purple-500 hover:text-white">Lihat
                                    Profil <i data-lucide="arrow-down"
                                        class="inline-block size-4 align-middle ltr:ml-1 rtl:mr-1"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-span-12 xl:col-span-7 2xl:col-span-6 2xl:col-start-8">
                    <div class="relative mt-10 xl:mt-0">
                        <div class="font-tourney absolute -top-20 text-center text-slate-100 lg:text-[10rem] xl:-right-40 2xl:text-[14rem] dark:text-zinc-800/60"
                            data-aos="zoom-in-down" data-aos-delay="1400"></div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--end -->

    @php
        $visionMenu = $menus->firstWhere('slug', 'section-visimisi');
        $profileMenu = $menus->firstWhere('slug', 'section-profil');
        $programMenu = $menus->firstWhere('slug', 'section-konsentrasi');
        $newsMenu = $menus->firstWhere('slug', 'section-berita');
        $extrakurikulerMenu = $menus->firstWhere('slug', 'section-ekskul');
        $galleryMenu = $menus->firstWhere('slug', 'section-gallery');

    @endphp

    {{-- Profil Sekolah --}}
    @if ($profileMenu)
        @foreach ($profiles as $p)
            @if ($p->menu && $p->menu->id === $profileMenu->id)
                <section class="relative py-24 pb-16 xl:py-32 xl:pb-20" id="{{ $p->menu->slug }}">
                    <div class="container mx-auto px-4 2xl:max-w-[87.5rem]">
                        <div class="mx-auto text-center xl:max-w-3xl">
                            <h1 class="mb-6 capitalize leading-normal">Profil<span
                                    class="relative mx-2 inline-block px-2 before:absolute before:-inset-1 before:block before:-skew-y-6 before:rounded-md before:bg-sky-50 before:backdrop-blur-xl dark:before:bg-sky-500/20"><span
                                        class="relative text-sky-500">SMKN 1 Talaga</span></span></h1>

                            <div class="profile-container">
                                @php
                                    $plain = trim(strip_tags($p->content ?? ''));
                                    $cut = 220; // character cutoff for summary
                                @endphp

                                <div class="dark:text-zink-200 profile-summary text-lg text-slate-500"
                                    style="display:inline-block; max-width:100%; word-break:break-word;">
                                    @php $summary = \Illuminate\Support\Str::limit($plain, $cut); @endphp
                                    <span style="display:inline">{{ $summary }}</span>
                                    @if (mb_strlen($plain) > $cut)
                                        <a href="{{ route('profiles.show', $p->id) }}"
                                            class="profile-readmore dark:text-zink-200 text-lg text-slate-500 hover:underline"
                                            style="white-space:nowrap; margin-left:.5rem; display:inline;"
                                            aria-label="Baca selengkapnya tentang profil sekolah">Selengkapnya</a>
                                    @endif
                                </div>
                            </div>
                        </div><!--end container-->
                </section><!--end -->
            @endif
        @endforeach
    @endif

    {{-- =============== Visi & Misi =============== --}}
    @if ($visionMenu)
        @foreach ($visionmissions as $v)
            @if ($v->menu && $v->menu->id === $visionMenu->id)
                <section class="relative py-24 pb-16 pt-4 xl:py-32 xl:pb-20" id="{{ $v->menu->slug }}">
                    <div class="container mx-auto px-4 2xl:max-w-[87.5rem]">
                        <div class="mx-auto text-center xl:max-w-3xl">
                            <h1 class="mb-0 capitalize leading-normal">Visi & Misi</h1>
                        </div>
                        <div class="mt-12 grid grid-cols-1 gap-5 md:grid-cols-2">
                            <div class="rounded-md bg-gradient-to-b from-slate-100 to-white p-8 dark:from-zinc-800 dark:to-zinc-900"
                                data-aos="fade-up" data-aos-easing="linear">
                                <h4 class="text-custom-500 mb-4 text-xl font-bold">Visi</h4>
                                <p class="text-slate-600 dark:text-zinc-300">{{ $v->vision ?? 'Belum ada visi.' }}</p>
                            </div><!--end-->

                            <div class="rounded-md bg-gradient-to-b from-slate-100 to-white p-8 dark:from-zinc-800 dark:to-zinc-900"
                                data-aos="fade-up" data-aos-easing="linear">
                                <h4 class="text-custom-500 mb-4 text-xl font-bold">Misi</h4>

                                <ol
                                    class="ms-8 list-outside list-decimal space-y-2 pl-4 ps-2 text-slate-600 dark:text-zinc-300">
                                    @foreach (preg_split("/\r\n|\r|\n/", $v->mission ?? '') as $misi)
                                        @php
                                            $cleanMisi = preg_replace('/^\s*\d+\.\s*/', '', $misi);
                                        @endphp

                                        @if (trim($cleanMisi) !== '')
                                            <li>{{ $cleanMisi }}</li>
                                        @endif
                                    @endforeach
                                </ol>
                            </div>

                        </div><!--end grid-->
                    </div><!--end container-->
                </section><!--end -->
            @endif
        @endforeach
    @endif

    {{-- =============== Berita Sekolah =============== --}}

    @if ($newsMenu && $news->count() > 0)
        <section id="{{ $newsMenu->slug }}" class="dark:bg-zink-700/40 relative bg-slate-50 py-24 pb-16 xl:py-32 xl:pb-20">
            <div class="container mx-auto px-4 2xl:max-w-[87.5rem]">
                <div class="mx-auto mb-8 text-center xl:max-w-3xl">
                    <h2 class="text-gradient mb-0 capitalize leading-normal">{{ $newsMenu->name ?? 'Berita Sekolah' }}
                    </h2>
                </div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($news as $index => $item)
                        <div class="{{ $index >= 6 ? 'hidden md:block' : '' }}">
                            <a href="{{ route('news.show', $item->id) }}" class="block">
                                <div class="flex h-[480px] flex-col overflow-hidden rounded-lg bg-white shadow-md transition-all duration-300 ease-linear hover:-translate-y-2 hover:shadow-lg dark:bg-zink-600"
                                    data-aos="fade-up" data-aos-easing="linear">

                                    <!-- Image Container - Fixed 192px -->
                                    <div class="relative h-48 flex-shrink-0 overflow-hidden bg-gray-100">
                                        @php
                                            $firstImgSrc = null;
                                            if (!empty($item->content)) {
                                                if (
                                                    preg_match('/<img[^>]+src="([^">]+)"/i', $item->content, $matches)
                                                ) {
                                                    $firstImgSrc = $matches[1];
                                                }
                                            }
                                        @endphp

                                        <img src="{{ $firstImgSrc ?? asset('assets/images/default-news.png') }}"
                                            alt="{{ $item->title }}" class="h-full w-full object-cover" loading="lazy" />

                                        @if ($item->categories)
                                            <span
                                                class="absolute right-3 top-3 rounded bg-gray-800 px-3 py-1 text-xs font-medium text-white">
                                                {{ $item->categories->name }}
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Content Container - Remaining space with strict overflow control -->
                                    <div class="flex min-h-0 flex-1 flex-col overflow-hidden p-4">
                                        <!-- Title - Fixed height 56px (2 lines) -->
                                        <h3
                                            class="mb-3 h-14 flex-shrink-0 overflow-hidden text-lg font-semibold leading-tight text-gray-900 dark:text-zink-50">
                                            <span class="line-clamp-2">{{ $item->title }}</span>
                                        </h3>

                                        <!-- Meta Information - Controlled height -->
                                        <div class="min-h-0 flex-1 overflow-hidden">
                                            <div class="flex flex-col gap-2 text-sm text-gray-600 dark:text-zink-200">
                                                <!-- Date - Single line -->
                                                <div class="flex items-start gap-2">
                                                    <span class="flex-shrink-0 text-cyan-500">📅</span>
                                                    <span
                                                        class="truncate">{{ $item->created_at->format('l, d F Y') }}</span>
                                                </div>

                                                <!-- Author - Single line -->
                                                @if ($item->created_by && $item->createdBy)
                                                    <div class="flex items-start gap-2">
                                                        <span class="flex-shrink-0 text-cyan-500">👤</span>
                                                        <span class="truncate">{{ $item->createdBy->name }}</span>
                                                    </div>
                                                @endif

                                                <!-- Preview - Max 3 lines -->
                                                <div class="flex items-start gap-2">
                                                    <span class="flex-shrink-0 text-cyan-500">📄</span>
                                                    <span class="line-clamp-3 min-w-0 flex-1">
                                                        {{ Str::limit(strip_tags($item->content), 100, '...') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div><!--end grid-->

                <!-- Tombol Lihat Semua Berita -->
                <div class="mt-8 flex justify-center">
                    <a href="{{ route('news.index') }}"
                        class="bg-custom-500 border-custom-500 hover:bg-custom-600 hover:border-custom-600 focus:bg-custom-600 focus:border-custom-600 inline-flex items-center gap-2 rounded border px-6 py-3 text-base font-medium text-white transition-all duration-200 ease-linear">
                        Lihat Semua Berita
                        <i data-lucide="arrow-right" class="size-4"></i>
                    </a>
                </div>
            </div>
        </section><!--end -->
    @endif

    {{-- =============== Program Keahlian =============== --}}

@if ($programMenu)
    @php
        // load programs and concentrations from DB (use facade with global alias)
        $programs = \DB::table('core_expertise_programs')->orderBy('name')->get();
        $concs = \DB::table('core_expertise_concentrations')->orderBy('name')->get();

        // manual mapping: ensure Otomotif groups TKR & TSM
        // and map Bisnis Ritel (BR) to Pemasaran (PN)
        $manualMap = [
            'teknik-otomotif-to' => ['teknik-kendaraan-ringan-tkr', 'teknik-sepeda-motor-tsm'],
            'pemasaran-pn' => ['bisnis-ritel-br'],
        ];

        // prepare containers
        $assigned = [];
        $groups = [];
        foreach ($programs as $p) {
            $groups[$p->slug] = ['program' => $p, 'subs' => []];
        }

        // apply manual mapping first
        foreach ($manualMap as $progSlug => $concSlugs) {
            foreach ($concSlugs as $cslug) {
                $found = $concs->firstWhere('slug', $cslug);
                if ($found) {
                    if (isset($groups[$progSlug])) {
                        $groups[$progSlug]['subs'][] = $found;
                        $assigned[$found->slug] = true;
                    }
                }
            }
        }

        // assign remaining concentrations by token similarity
        foreach ($concs as $c) {
            if (isset($assigned[$c->slug])) {
                continue;
            }

            $bestProg = null;
            $bestScore = -1;
            $cTokens = explode('-', $c->slug);
            foreach ($programs as $p) {
                $pTokens = explode('-', $p->slug);
                $score = count(array_intersect($cTokens, $pTokens));
                if ($score > $bestScore) {
                    $bestScore = $score;
                    $bestProg = $p;
                }
            }

            // fallback: if no shared tokens, put into first program
            if (!$bestProg) {
                $bestProg = $programs->first();
            }

            $groups[$bestProg->slug]['subs'][] = $c;
            $assigned[$c->slug] = true;
        }
    @endphp

    <section id="{{ $programMenu->slug }}"
        class="dark:from-zink-700/40 dark:to-zink-600/40 relative bg-gradient-to-r from-slate-50 to-slate-100 py-24 pb-16 xl:py-32 xl:pb-20">
        <div class="container mx-auto px-4 2xl:max-w-[87.5rem]">
            <div class="mx-auto mb-14 text-center xl:max-w-3xl">
                <h1 class="mb-0 capitalize leading-normal">Program Keahlian</h1>
            </div>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($groups as $g)
                    @php
                        $p = $g['program'];
                        $subs = $g['subs'];
                    @endphp
                    <div class="dark:bg-zink-600 program-card rounded-md bg-white p-7 shadow-md transition-all duration-300 ease-linear hover:-translate-y-2"
                        data-aos="fade-up" data-aos-easing="linear">
                        <div class="program-header flex items-center gap-4" style="cursor:pointer">
                            <div class="shrink-0">
                                <div
                                    class="bg-custom-100 dark:bg-custom-500/20 flex h-12 w-12 items-center justify-center rounded-full">
                                    <i data-lucide="graduation-cap" class="text-custom-500 size-6"></i>
                                </div>
                            </div>
                            <div class="grow">
                                <h5 class="dark:text-zink-50 text-base font-semibold text-slate-800">
                                    {{ $p->name }}</h5>
                            </div>
                        </div>

                        {{-- HAPUS INLINE STYLE DI SINI --}}
                        <div class="program-subs mt-4">
                            @if (count($subs) === 0)
                                <div class="text-sm text-slate-500">Belum ada konsentrasi terdaftar.</div>
                            @else
                                @foreach ($subs as $index => $s)
                                    <a href="{{ route('expertise.show', $s->slug) }}"
                                        class="program-sub block rounded border border-slate-200 px-3 py-2 mb-2 text-slate-700 hover:bg-slate-50 dark:border-zinc-500 dark:text-zinc-100 dark:hover:bg-zinc-500"
                                        data-index="{{ $index }}">{{ $s->name }}</a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <style>
        .program-subs {
            max-height: 0;
            overflow: hidden;
            opacity: 0;
            transition: max-height 0.4s ease, opacity 0.3s ease;
        }

        .program-card.open .program-subs {
            opacity: 1;
        }

        .program-sub {
            opacity: 0;
            transform: translateY(-6px);
            transition: opacity 0.32s ease, transform 0.32s ease;
        }

        .program-card.open .program-sub {
            opacity: 1;
            transform: translateY(0);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.program-card');

            function closeCard(card) {
                const subs = card.querySelector('.program-subs');
                if (!subs) return;

                card.classList.remove('open');
                subs.style.maxHeight = '0';

                // Reset animasi sub items
                subs.querySelectorAll('.program-sub').forEach((el) => {
                    el.style.transitionDelay = '0ms';
                });
            }

            function openCard(card) {
                const subs = card.querySelector('.program-subs');
                if (!subs) return;

                // Close cards lain (accordion behavior)
                document.querySelectorAll('.program-card.open').forEach((c) => {
                    if (c === card) return;
                    closeCard(c);
                });

                card.classList.add('open');

                // Set max-height ke scrollHeight untuk trigger transition
                const fullHeight = subs.scrollHeight;
                subs.style.maxHeight = fullHeight + 'px';

                // Animasi staggered untuk sub items
                subs.querySelectorAll('.program-sub').forEach((el, i) => {
                    el.style.transitionDelay = (i * 60) + 'ms';
                });
            }

            cards.forEach((card) => {
                const header = card.querySelector('.program-header');
                if (!header) return;

                header.addEventListener('click', function() {
                    if (card.classList.contains('open')) {
                        closeCard(card);
                    } else {
                        openCard(card);
                    }
                });
            });
        });
    </script>
@endif
    {{-- =============== Ekstrakurikuler =============== --}}
    @if ($extrakurikulerMenu && $extrakurikulers->count() > 0)
        <section class="relative py-24 xl:py-32" id="{{ $extrakurikulerMenu->slug }}">
            <div class="container mx-auto px-4 2xl:max-w-[87.5rem]">
                <div class="mx-auto mb-8 text-center xl:max-w-3xl">
                    <h1 class="mb-0 capitalize leading-normal">{{ $extrakurikulerMenu->name ?? 'Ekstrakurikuler' }}</h1>
                </div>
                <!-- Swiper -->
                <div class="swiper feedback-slider pb-6">
                    <div class="swiper-wrapper">
                        @foreach ($extrakurikulers as $item)
                            <div class="swiper-slide flex flex-col">
                                <a href="{{ route('ekstrakurikulers.show', $item->id) }}">

                                    <div class="p-5 text-center flex-1 flex flex-col" data-aos="fade-up"
                                        data-aos-easing="linear">
                                        <div class="mx-auto w-28 h-28 flex items-center justify-center mb-4">
                                            @if (!empty($item->photo))
                                                @php
                                                    $p = $item->photo;
                                                    if (filter_var($p, FILTER_VALIDATE_URL)) {
                                                        $imgUrl = $p;
                                                    } elseif (
                                                        preg_match('#^assets/#', $p) ||
                                                        preg_match('#^public/assets/#', $p)
                                                    ) {
                                                        $imgUrl = asset(preg_replace('#^public/#', '', $p));
                                                    } else {
                                                        $rel = preg_replace('#^storage/#', '', $p);
                                                        $imgUrl = route('public.files', ['path' => $rel]);
                                                    }
                                                @endphp
                                                <img src="{{ $imgUrl }}" alt="{{ $item->name }}"
                                                    class="max-w-full max-h-full object-contain"
                                                    onerror="this.src='{{ asset('assets/images/default-extrakurikuler.png') }}'">
                                            @else
                                                <img src="{{ asset('assets/images/default-extrakurikuler.png') }}"
                                                    alt="{{ $item->name }}"
                                                    class="max-w-full max-h-full object-contain">
                                            @endif
                                        </div>
                                        <h6 class="mb-1 mt-4 text-3xl">{{ $item->name }}</h6>
                                        <p class="text-16 mt-2">"{{ $item->description }}"</p>

                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div><!--end container-->
        </section><!--end -->
    @endif

    {{-- =============== Mitra Industri =============== --}}
    @if (!empty($mitras) && $mitras->count() > 0)
        <section class="relative py-24 xl:py-32" id="section-mitra">
            <div class="container mx-auto px-4 2xl:max-w-[87.5rem]">
                <div class="mx-auto mb-8 text-center xl:max-w-3xl">
                    <h1 class="mb-0 capitalize leading-normal">Mitra Industri</h1>
                </div>
                <!-- Swiper (reuse same classes as ekstrakurikuler for horizontal auto animation) -->
                <div class="swiper mitra-slider pb-6">
                    <div class="swiper-wrapper">
                        @foreach ($mitras as $item)
                            <div class="swiper-slide flex flex-col">
                                <div class="p-5 text-center flex-1 flex flex-col" data-aos="fade-up"
                                    data-aos-easing="linear">
                                    <div class="mx-auto w-28 h-28 flex items-center justify-center mb-4">
                                        @if (!empty($item->photo))
                                            @php
                                                $p = $item->photo;
                                                if (filter_var($p, FILTER_VALIDATE_URL)) {
                                                    $imgUrl = $p;
                                                } elseif (
                                                    preg_match('#^assets/#', $p) ||
                                                    preg_match('#^public/assets/#', $p)
                                                ) {
                                                    $imgUrl = asset(preg_replace('#^public/#', '', $p));
                                                } else {
                                                    $rel = preg_replace('#^storage/#', '', $p);
                                                    $imgUrl = route('public.files', ['path' => $rel]);
                                                }
                                            @endphp
                                            <img src="{{ $imgUrl }}" alt="{{ $item->name }}"
                                                class="max-w-full max-h-full object-contain"
                                                onerror="this.src='{{ asset('assets/images/default-extrakurikuler.png') }}'">
                                        @else
                                            <img src="{{ asset('assets/images/default-extrakurikuler.png') }}"
                                                alt="{{ $item->name }}" class="max-w-full max-h-full object-contain">
                                        @endif
                                    </div>
                                    <h6 class="mb-1 text-3xl">{{ $item->name }}</h6>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div><!--end container-->
        </section>
    @endif

    {{-- =============== Galleries (Galeri) =============== --}}
    @if (!empty($galleries) && $galleries->count() > 0)
        @if ($galleryMenu)
            @php
                $sectionId = $galleryMenu->slug ?? 'section-gallery';
            @endphp
        @else
            @php
                $sectionId = 'section-gallery';
            @endphp
        @endif

        <section id="{{ $sectionId }}" class="dark:bg-zink-800/20 relative bg-white py-24 pb-16 xl:py-32 xl:pb-20">
            <div class="container mx-auto px-4 2xl:max-w-[87.5rem]">
                <div class="mx-auto mb-8 text-center xl:max-w-3xl">
                    <h2 class="text-gradient mb-0 capitalize leading-normal">Galeri</h2>
                </div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    {{-- Photos column (left) --}}
                    <div class="space-y-4">
                        <div class="text-center font-semibold mb-4">Foto</div>
                        @php $photos = $galleries->where('type', 'photo')->take(3); @endphp
                        @if ($photos->count() === 0)
                            <div class="text-slate-500">Belum ada foto.</div>
                        @endif
                        @foreach ($photos as $item)
                            <div class="card dark:bg-zink-600 cursor-pointer transition-all duration-300 ease-linear hover:-translate-y-2"
                                data-aos="fade-up" data-aos-easing="linear"
                                @if (Route::has('galleries.show')) onclick="window.location.href='{{ route('galleries.show', $item->id) }}'" @endif>
                                <div class="flex gap-4 p-4">
                                    <div class="shrink-0">
                                        <div
                                            class="group/gallery card relative mb-0 overflow-hidden rounded-md transition-all duration-300 ease-linear hover:-translate-y-2">
                                            <div class="group/gallery relative overflow-hidden rounded-md">
                                                <div
                                                    style="width:200px; aspect-ratio:1/1; display:flex; align-items:center; justify-content:center; overflow:hidden; background-color:#f3f4f6; position:relative;">
                                                    @if ($item->embed_html)
                                                        <div style="width:100%; height:100%; pointer-events:none;">
                                                            {!! $item->embed_html !!}
                                                        </div>
                                                        <div style="position:absolute; inset:0; z-index:10;"></div>
                                                    @else
                                                        <img src="{{ asset('assets/images/default-news.png') }}"
                                                            alt="{{ $item->title }}"
                                                            style="width:100%; height:100%; object-fit:cover;"
                                                            class="rounded-md">
                                                    @endif
                                                </div>

                                                <div
                                                    class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent opacity-0 transition-all duration-300 ease-linear group-hover/gallery:opacity-50">
                                                </div>
                                                <div
                                                    class="absolute bottom-0 left-3 right-3 z-20 opacity-0 transition-all duration-300 ease-linear group-hover/gallery:bottom-3 group-hover/gallery:opacity-100">
                                                    <h5 class="truncate font-normal text-white">{{ $item->title }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="grow">
                                        <h6
                                            class="dark:text-zink-50 hover:text-custom-500 mb-2 text-lg font-semibold text-slate-800 transition-colors">
                                            {{ $item->title }}</h6>
                                        <p class="dark:text-zink-200 mb-2 text-sm text-slate-500">
                                            {{ Str::limit(strip_tags($item->description ?? ($item->caption ?? '')), 150) }}
                                        </p>
                                        <p class="dark:text-zink-300 text-xs text-slate-400">
                                            {{ optional($item->created_at)->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Videos column (right) --}}
                    <div class="space-y-4">
                        <div class="text-center font-semibold mb-4">Video</div>
                        @php $videos = $galleries->where('type', 'video')->take(3); @endphp
                        @if ($videos->count() === 0)
                            <div class="text-slate-500">Belum ada video.</div>
                        @endif
                        @foreach ($videos as $item)
                            <div class="card dark:bg-zink-600 cursor-pointer transition-all duration-300 ease-linear hover:-translate-y-2"
                                data-aos="fade-up" data-aos-easing="linear"
                                @if (Route::has('galleries.show')) onclick="window.location.href='{{ route('galleries.show', $item->id) }}'" @endif>
                                <div class="flex items-start gap-4 p-4">
                                    <div class="shrink-0">
                                        <div
                                            class="group/gallery card relative mb-0 overflow-hidden rounded-md transition-all duration-300 ease-linear hover:-translate-y-2">
                                            <div class="group/gallery relative overflow-hidden rounded-md">
                                                <div
                                                    style="width:100%; max-width:400px; aspect-ratio:16/9; display:flex; align-items:center; justify-content:center; overflow:hidden; background-color:#f3f4f6; position:relative;">
                                                    @if ($item->embed_html)
                                                        <div style="width:100%; height:100%; pointer-events:none;">
                                                            {!! $item->embed_html !!}
                                                        </div>
                                                        <div style="position:absolute; inset:0; z-index:10;"></div>
                                                    @else
                                                        <img src="{{ asset('assets/images/default-news.png') }}"
                                                            alt="{{ $item->title }}"
                                                            style="width:100%; height:100%; object-fit:cover;"
                                                            class="rounded-md">
                                                    @endif
                                                </div>

                                                <div
                                                    class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent opacity-0 transition-all duration-300 ease-linear group-hover/gallery:opacity-50">
                                                </div>
                                                <div
                                                    class="absolute bottom-0 left-3 right-3 z-20 opacity-0 transition-all duration-300 ease-linear group-hover/gallery:bottom-3 group-hover/gallery:opacity-100">
                                                    <h5 class="truncate font-normal text-white">{{ $item->title }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="grow">
                                        <h6
                                            class="dark:text-zink-50 hover:text-custom-500 mb-2 text-lg font-semibold text-slate-800 transition-colors">
                                            {{ $item->title }}</h6>
                                        <p class="dark:text-zink-200 mb-2 text-sm text-slate-500">
                                            {{ Str::limit(strip_tags($item->description ?? ($item->caption ?? '')), 150) }}
                                        </p>
                                        <p class="dark:text-zink-300 text-xs text-slate-400">
                                            {{ optional($item->created_at)->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div><!--end grid-->
            </div>
        </section>
        <!--end grid-->

        <!-- Tombol Lihat Semua Galeri -->
        <div class="mt-8 flex justify-center">
            @if (Route::has('galleries.index'))
                <a href="{{ route('galleries.index') }}"
                    class="bg-custom-500 border-custom-500 hover:bg-custom-600 hover:border-custom-600 focus:bg-custom-600 focus:border-custom-600 inline-flex items-center gap-2 rounded border px-6 py-3 text-base font-medium text-white transition-all duration-200 ease-linear">
                    Lihat Semua Galeri
                    <i data-lucide="arrow-right" class="size-4"></i>
                </a>
            @endif
        </div>
        </div>
        </section><!--end -->
    @endif
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const cards = document.querySelectorAll('.program-card');

                function closeCard(card) {
                    const subs = card.querySelector('.program-subs');
                    if (!subs) return;
                    card.classList.remove('open');
                    subs.style.maxHeight = '0';
                    subs.style.opacity = '0';
                    subs.querySelectorAll('.program-sub').forEach((el) => {
                        el.style.transitionDelay = '0ms';
                        el.style.opacity = '0';
                        el.style.transform = 'translateY(-6px)';
                    });
                }

                function openCard(card) {
                    const subs = card.querySelector('.program-subs');
                    if (!subs) return;
                    // close other open cards (accordion behavior)
                    document.querySelectorAll('.program-card.open').forEach((c) => {
                        if (c === card) return;
                        closeCard(c);
                    });

                    card.classList.add('open');
                    subs.style.opacity = '1';
                    // allow the browser to compute layout then set maxHeight for transition
                    const full = subs.scrollHeight;
                    subs.style.maxHeight = full + 'px';

                    subs.querySelectorAll('.program-sub').forEach((el, i) => {
                        el.style.opacity = '0';
                        el.style.transform = 'translateY(-6px)';
                        el.style.transition = 'opacity 320ms ease, transform 320ms ease';
                        el.style.transitionDelay = (i * 60) + 'ms';
                        requestAnimationFrame(() => {
                            el.style.opacity = '1';
                            el.style.transform = 'translateY(0)';
                        });
                    });
                }

                cards.forEach((card) => {
                    const header = card.querySelector('.program-header');
                    const subs = card.querySelector('.program-subs');
                    if (!header || !subs) return;
                    // initialize subs children for hidden state
                    subs.querySelectorAll('.program-sub').forEach((el) => {
                        el.style.opacity = '0';
                        el.style.transform = 'translateY(-6px)';
                    });

                    header.addEventListener('click', function() {
                        if (card.classList.contains('open')) {
                            closeCard(card);
                        } else {
                            openCard(card);
                        }
                    });
                });
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize Swiper for mitra slider if Swiper is available
                try {
                    if (typeof Swiper !== 'undefined') {
                        new Swiper('.mitra-slider', {
                            slidesPerView: 3,
                            spaceBetween: 20,
                            loop: true,
                            autoplay: {
                                delay: 2200,
                                disableOnInteraction: false,
                            },
                            pagination: {
                                el: '.mitra-slider .swiper-pagination',
                                clickable: true,
                            },
                            breakpoints: {
                                320: {
                                    slidesPerView: 1
                                },
                                640: {
                                    slidesPerView: 2
                                },
                                1024: {
                                    slidesPerView: 3
                                },
                            }
                        });
                    }
                } catch (e) {
                    console.error('Swiper init error', e);
                }
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // show 'Selengkapnya' if profile content is overflowing 2 lines
                document.querySelectorAll('.profile-summary').forEach(function(el) {
                    // small tolerance to account for rounding
                    if (el.scrollHeight > el.clientHeight + 2) {
                        // prefer an ancestor wrapper with a known class, fallback to parent
                        var container = el.closest('.profile-container') || el.parentElement;
                        var btn = container ? container.querySelector('.profile-readmore') : null;
                        if (btn) {
                            btn.style.display = 'inline';
                        }
                    }
                });
            });
        </script>
    @endpush

@endsection
