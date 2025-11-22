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

    <section class="relative pb-28 xl:pb-36 pt-44 xl:pt-52" id="home" style="min-height:100vh;">
        <div class="absolute top-0 left-0 size-64 bg-custom-500 opacity-10 blur-3xl z-10"></div>
        <div class="absolute bottom-0 right-0 size-64 bg-purple-500/10 blur-3xl z-10"></div>
        @php
            $heroImage = null;
            if (!empty($heroProfile->photo)) {
                $heroImage = $heroProfile->photo;
            } else {
                $heroImage = 'assets/images/smk.jpg';
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
        <div class="absolute inset-0 hero-bleed" style="background-image: url('{{ $heroImageUrl }}'); background-repeat:no-repeat; background-position: center right; background-size: cover; z-index:0; opacity:0.5;">
            <!-- optional overlay for contrast -->
        </div>
        <div class="container 2xl:max-w-[87.5rem] px-4 mx-auto" style="position:relative; z-index:1;">
            <div class="grid items-center grid-cols-12 gap-5 2xl:grid-cols-12">


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

                    <div class="hero-bg p-6 rounded-lg bg-transparent" style="background:transparent;">
                        <div class="hero-content">
                            <h1 class="mb-4 !leading-normal lg:text-5xl 2xl:text-6xl dark:text-zinc-100" data-aos="fade-right" data-aos-delay="300"> Selamat Datang di Website Resmi SMKN 1 Talaga</h1>
                            <p class="text-lg mb-7 dark:text-zinc-400" data-aos="fade-right" data-aos-delay="600"> SMKN 1 Talaga adalah Sekolah Menengah Kejuruan Negeri di Talaga, Majalengka, Jawa Barat yang membekali siswa dengan keterampilan praktis.</p>
                            <div class="flex items-center gap-2" data-aos="fade-right" data-aos-delay="800">
                                <a href="#{{ $profileMenu->slug ?? 'section-profil' }}" class="px-8 py-3 text-white border-0 text-15 btn bg-gradient-to-r from-custom-500 to-purple-500 hover:text-white hover:from-purple-500 hover:to-custom-500">Lihat Profil <i data-lucide="arrow-down" class="inline-block align-middle size-4 rtl:mr-1 ltr:ml-1"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-span-12 xl:col-span-7 2xl:col-start-8 2xl:col-span-6">
                    <div class="relative mt-10 xl:mt-0">
                        <div class="absolute text-center -top-20 xl:-right-40 lg:text-[10rem] 2xl:text-[14rem] text-slate-100 dark:text-zinc-800/60 font-tourney" data-aos="zoom-in-down" data-aos-delay="1400"></div>
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
        $extrakurikulerMenu = $menus->firstWhere('slug', 'section-galeri');

    @endphp

    {{-- Profil Sekolah --}}
    @if ($profileMenu)
        @foreach ($profiles as $p)
            @if ($p->menu && $p->menu->id === $profileMenu->id)
                <section class="relative py-24 xl:py-32 pb-16 xl:pb-20" id="{{ $p->menu->slug }}">
                    <div class="container 2xl:max-w-[87.5rem] px-4 mx-auto">
                        <div class="mx-auto text-center xl:max-w-3xl">
                                            <h1 class="mb-6 leading-normal capitalize">Profil<span class="relative inline-block px-2 mx-2 before:block before:absolute before:-inset-1 before:-skew-y-6 before:bg-sky-50 dark:before:bg-sky-500/20 before:rounded-md before:backdrop-blur-xl"><span class="relative text-sky-500">SMKN 1 Talaga</span></span></h1>

                            <div class="profile-container">
                                @php
                                    $plain = trim(strip_tags($p->content ?? ''));
                                    $cut = 220; // character cutoff for summary
                                @endphp

                                <div class="text-lg text-slate-500 dark:text-zink-200 profile-summary" style="display:inline-block; max-width:100%; word-break:break-word;">
                                    @php $summary = \Illuminate\Support\Str::limit($plain, $cut); @endphp
                                    <span style="display:inline">{{ $summary }}</span>
                                    @if(mb_strlen($plain) > $cut)
                                        <a href="{{ route('profiles.show', $p->id) }}" class="profile-readmore text-lg text-slate-500 dark:text-zink-200 hover:underline" style="white-space:nowrap; margin-left:.5rem; display:inline;" aria-label="Baca selengkapnya tentang profil sekolah">Selengkapnya</a>
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
                <section class="relative py-24 xl:py-32 pb-16 xl:pb-20 pt-4" id="{{ $v->menu->slug }}">
                    <div class="container 2xl:max-w-[87.5rem] px-4 mx-auto">
                        <div class="mx-auto text-center xl:max-w-3xl">
                            <h1 class="mb-0 leading-normal capitalize">Visi & Misi</h1>
                        </div>
                        <div class="grid grid-cols-1 gap-5 mt-12 md:grid-cols-2">
                            <div class="p-8 rounded-md bg-gradient-to-b from-slate-100 to-white dark:from-zinc-800 dark:to-zinc-900"
                                data-aos="fade-up" data-aos-easing="linear">
                                <h4 class="text-custom-500 font-bold mb-4 text-xl">Visi</h4>
                                <p class="text-slate-600 dark:text-zinc-300">{{ $v->vision ?? 'Belum ada visi.' }}</p>
                            </div><!--end-->

                            <div class="p-8 rounded-md bg-gradient-to-b from-slate-100 to-white dark:from-zinc-800 dark:to-zinc-900"
                                data-aos="fade-up" data-aos-easing="linear">
                                <h4 class="text-custom-500 font-bold mb-4 text-xl">Misi</h4>

                                <ol
                                    class="list-decimal list-outside pl-4 ms-8 ps-2 space-y-2 text-slate-600 dark:text-zinc-300">
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
        <section id="{{ $newsMenu->slug }}" class="relative py-24 xl:py-32 pb-16 xl:pb-20 bg-slate-50 dark:bg-zink-700/40">
            <div class="container 2xl:max-w-[87.5rem] px-4 mx-auto">
                <div class="mx-auto text-center xl:max-w-3xl mb-8">
                    <h2 class="mb-0 leading-normal capitalize text-gradient">{{ $newsMenu->name ?? 'Berita Sekolah' }}</h2>
                </div>

                <div class="grid grid-cols-1 gap-6">
                    @foreach ($news as $item)
                        <div class="transition-all duration-300 ease-linear card hover:-translate-y-2 dark:bg-zink-600"
                            data-aos="fade-up" data-aos-easing="linear">
                            <div class="flex gap-4 p-4">
                                <div class="shrink-0">
                                    <div
                                        class="relative mb-0 overflow-hidden transition-all duration-300 ease-linear rounded-md group/gallery card hover:-translate-y-2">
                                        @php
                                            $firstImg = null;
                                            if (
                                                isset($item->content) &&
                                            preg_match('/<img.+@endphp/i', $item->content, $matches)
                                            ) {
                                            $firstImg = $matches[0];

                                            // Sanitize extracted <img> so inline width/height/style don't break layout
                                            libxml_use_internal_errors(true);
                                            $doc = new \DOMDocument();
                                            // Ensure proper encoding
                                            $doc->loadHTML(
                                                mb_convert_encoding($firstImg, 'HTML-ENTITIES', 'UTF-8'),
                                            );
                                            $imgTag = $doc->getElementsByTagName('img')->item(0);
                                            if ($imgTag) {
                                                // remove width/height attributes
                                                $imgTag->removeAttribute('width');
                                                $imgTag->removeAttribute('height');

                                                // clean style attribute (remove width/height declarations)
                                                $style = $imgTag->getAttribute('style');
                                                $style = preg_replace(
                                                    '/(width|height)\s*:\s*[^;]+;?/i',
                                                    '',
                                                    $style,
                                                );
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


                                        <div class="relative overflow-hidden rounded-md group/gallery">
                                            <div
                                                style="width:150px; height:150px; display:flex; align-items:center; justify-content:center; overflow:hidden;">
                                                @if ($firstImg)
                                                    <div
                                                        style="max-width:100%; max-height:100%; display:flex; align-items:center; justify-content:center;">
                                                        {!! $firstImg !!}
                                                    </div>
                                                @else
                                                    <img src="{{ asset('assets/images/default-news.png') }}" alt=""
                                                        style="max-width:100%; max-height:100%; object-fit:contain;"
                                                        class="rounded-md">
                                                @endif
                                            </div>

                                            <div
                                                class="absolute inset-0 transition-all duration-300 ease-linear opacity-0 group-hover/gallery:opacity-50 bg-gradient-to-t from-gray-900 to-transparent">
                                            </div>
                                            <div
                                                class="absolute bottom-0 transition-all duration-300 ease-linear opacity-0 left-3 right-3 group-hover/gallery:opacity-100 group-hover/gallery:bottom-3">
                                                <h5 class="font-normal text-white"><a
                                                        href="{{ route('news.show', $item->id) }}">{{ $item->title }}</a>
                                                </h5>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="grow">
                                    <a href="{{ route('news.show', $item->id) }}"
                                        class="text-slate-800 dark:text-zink-50 hover:text-custom-500">
                                        @if ($item->categories)
                                            <span
                                                class="px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-sky-100 border-sky-200 text-sky-500 dark:bg-sky-500/20 dark:border-sky-500/20 mb-2">
                                                {{ $item->categories->name ?? 'Tanpa Kategori' }}
                                            </span>
                                        @endif
                                        <h6 class="mb-2 text-lg font-semibold">
                                            {{ $item->title }}

                                        </h6>
                                        <p class="text-sm text-slate-500 dark:text-zink-200 mb-2">
                                            {{ Str::limit(strip_tags($item->content), 150) }}
                                        </p>
                                        <p class="text-xs text-slate-400 dark:text-zink-300">
                                            {{ $item->created_at->diffForHumans() }}
                                        </p>
                                    </a>
                                </div>
                            </div>
                        </div><!--end col-->
                    @endforeach
                </div><!--end grid-->

                <!-- Tombol Lihat Semua Berita -->
                <div class="flex justify-center mt-8">
                    <a href="{{ route('news.index') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 text-base font-medium text-white transition-all duration-200 ease-linear bg-custom-500 border border-custom-500 rounded hover:bg-custom-600 hover:border-custom-600 focus:bg-custom-600 focus:border-custom-600">
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
                if (isset($assigned[$c->slug])) continue;

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

        <section id="{{ $programMenu->slug }}" class="relative py-24 xl:py-32 pb-16 xl:pb-20 bg-gradient-to-r from-slate-50 to-slate-100 dark:from-zink-700/40 dark:to-zink-600/40">
            <div class="container 2xl:max-w-[87.5rem] px-4 mx-auto">
                <div class="mx-auto text-center xl:max-w-3xl mb-14">
                    <h1 class="mb-0 leading-normal capitalize">Program Keahlian</h1>
                </div>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3">
                    @foreach ($groups as $g)
                        @php $p = $g['program']; $subs = $g['subs']; @endphp
                        <div class="p-7 rounded-md bg-white shadow-md dark:bg-zink-600 transition-all duration-300 ease-linear hover:-translate-y-2 program-card" data-aos="fade-up" data-aos-easing="linear">
                            <div class="flex items-center gap-4 program-header" style="cursor:pointer">
                                <div class="shrink-0">
                                    <div class="flex items-center justify-center w-12 h-12 rounded-full bg-custom-100 dark:bg-custom-500/20">
                                        <i data-lucide="graduation-cap" class="size-6 text-custom-500"></i>
                                    </div>
                                </div>
                                <div class="grow">
                                    <h5 class="text-base font-semibold text-slate-800 dark:text-zink-50">{{ $p->name }}</h5>
                                </div>
                            </div>

                            <div class="mt-4 program-subs" style="max-height:0; overflow:hidden; opacity:0; transition: max-height 380ms ease, opacity 280ms ease;">
                                @if(count($subs) === 0)
                                    <div class="text-sm text-slate-500">Belum ada konsentrasi terdaftar.</div>
                                @else
                                    @foreach($subs as $index => $s)
                                        <a href="{{ route('expertise.show', $s->slug) }}" class="block rounded border px-3 py-2 hover:bg-slate-50 program-sub" data-index="{{ $index }}">{{ $s->name }}</a>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif


    {{-- =============== Ekstrakurikuler =============== --}}
    @if ($extrakurikulerMenu && $extrakurikulers->count() > 0)
        <section class="relative py-24 xl:py-32" id="{{ $extrakurikulerMenu->slug }}">
            <div class="container 2xl:max-w-[87.5rem] px-4 mx-auto">
                <div class="mx-auto mb-8 text-center xl:max-w-3xl">
                    <h1 class="mb-0 leading-normal capitalize">{{ $extrakurikulerMenu->name ?? 'Ekstrakurikuler' }}</h1>
                </div>
                <!-- Swiper -->
                <div class="pb-6 swiper feedback-slider">
                    <div class="swiper-wrapper">
                        @foreach ($extrakurikulers as $item)
                            <div class="swiper-slide">
                                <div class="p-5 text-center" data-aos="fade-up" data-aos-easing="linear">
                                    <div class="mx-auto rounded-full size-20 bg-custom-500/10">
                                        @if (!empty($item->photo))
                                            @php
                                                $p = $item->photo;
                                                if (filter_var($p, FILTER_VALIDATE_URL)) {
                                                    $imgUrl = $p;
                                                } elseif (preg_match('#^assets/#', $p) || preg_match('#^public/assets/#', $p)) {
                                                    $imgUrl = asset(preg_replace('#^public/#', '', $p));
                                                } else {
                                                    $rel = preg_replace('#^storage/#', '', $p);
                                                    $imgUrl = route('public.files', ['path' => $rel]);
                                                }
                                            @endphp
                                            <img src="{{ $imgUrl }}" alt="{{ $item->name }}" class="rounded-full size-20 object-cover"
                                                onerror="this.src='{{ asset('assets/images/default-extrakurikuler.png') }}'">
                                        @else
                                            <img src="{{ asset('assets/images/default-extrakurikuler.png') }}" alt="{{ $item->name }}"
                                                class="rounded-full size-20 object-cover">
                                        @endif
                                    </div>
                                    <p class="mt-6 text-16">"{{ $item->description }}"</p>
                                    <h6 class="mt-4 mb-1 text-3xl">{{ $item->name }}</h6>
                                </div>
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
            <div class="container 2xl:max-w-[87.5rem] px-4 mx-auto">
                <div class="mx-auto mb-8 text-center xl:max-w-3xl">
                    <h1 class="mb-0 leading-normal capitalize">Mitra Industri</h1>
                </div>
                <!-- Swiper (reuse same classes as ekstrakurikuler for horizontal auto animation) -->
                <div class="pb-6 swiper mitra-slider">
                    <div class="swiper-wrapper">
                        @foreach ($mitras as $item)
                            <div class="swiper-slide">
                                <div class="p-5 text-center" data-aos="fade-up" data-aos-easing="linear">
                                    <div class="mx-auto rounded-full size-20 bg-custom-500/10">
                                        @if (!empty($item->photo))
                                            @php
                                                $p = $item->photo;
                                                if (filter_var($p, FILTER_VALIDATE_URL)) {
                                                    $imgUrl = $p;
                                                } elseif (preg_match('#^assets/#', $p) || preg_match('#^public/assets/#', $p)) {
                                                    $imgUrl = asset(preg_replace('#^public/#', '', $p));
                                                } else {
                                                    $rel = preg_replace('#^storage/#', '', $p);
                                                    $imgUrl = route('public.files', ['path' => $rel]);
                                                }
                                            @endphp
                                            <img src="{{ $imgUrl }}" alt="{{ $item->name }}" class="rounded-full size-20 object-cover"
                                                onerror="this.src='{{ asset('assets/images/default-extrakurikuler.png') }}'">
                                        @else
                                            <img src="{{ asset('assets/images/default-extrakurikuler.png') }}" alt="{{ $item->name }}" class="rounded-full size-20 object-cover">
                                        @endif
                                    </div>
                                    <h6 class="mt-4 mb-1 text-3xl">{{ $item->name }}</h6>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div><!--end container-->
        </section><!--end -->
    @endif

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
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

                header.addEventListener('click', function () {
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
        document.addEventListener('DOMContentLoaded', function () {
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
                            320: { slidesPerView: 1 },
                            640: { slidesPerView: 2 },
                            1024: { slidesPerView: 3 },
                        }
                    });
                }
            } catch (e) {
                console.error('Swiper init error', e);
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // show 'Selengkapnya' if profile content is overflowing 2 lines
            document.querySelectorAll('.profile-summary').forEach(function (el) {
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
