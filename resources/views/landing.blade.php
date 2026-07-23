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

        // Background / Hero Image resolution logic
        $heroImage = null;
        $foundAssetBackground = null;
        $matches = @glob(public_path('assets/images/background.*')) ?: [];
        if (!empty($matches)) {
            $foundAssetBackground = 'assets/images/' . basename($matches[0]);
        }

        if ($foundAssetBackground) {
            $heroImage = $foundAssetBackground;
        } elseif (!empty($heroProfile->photo)) {
            $heroImage = $heroProfile->photo;
        } else {
            $heroImage = 'assets/images/background.png';
        }

        if (filter_var($heroImage, FILTER_VALIDATE_URL)) {
            $heroImageUrl = $heroImage;
        } elseif (preg_match('#^assets/#', $heroImage) || preg_match('#^public/assets/#', $heroImage)) {
            $heroImageUrl = asset(preg_replace('#^public/#', '', $heroImage));
        } else {
            $rel = preg_replace('#^storage/#', '', $heroImage);
            $heroImageUrl = route('public.files', ['path' => $rel]);
        }
    @endphp

    <!-- Hero Section -->
    <section id="home" class="hero section">
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <div class="trust-badges mb-4" data-aos="fade-right" data-aos-delay="200">
                            <div class="badge-item">
                                <i class="bi bi-shield-check text-primary"></i>
                                <span>{{ $heroSettings->trust_badge_1 }}</span>
                            </div>
                            <div class="badge-item">
                                <i class="bi bi-award text-primary"></i>
                                <span>{{ $heroSettings->trust_badge_2 }}</span>
                            </div>
                            <div class="badge-item">
                                <i class="bi bi-flower1 text-primary"></i>
                                <span>{{ $heroSettings->trust_badge_3 }}</span>
                            </div>
                        </div>

                        <h1 data-aos="fade-right" data-aos-delay="300" style="font-size: 42px; font-weight: 800; line-height: 1.2; margin-bottom: 20px;">
                            {!! str_replace('SMKN 1 Talaga', '<span class="highlight text-primary">SMKN 1 Talaga</span>', e($heroSettings->hero_title)) !!}
                        </h1>

                        <p class="hero-description" data-aos="fade-right" data-aos-delay="400" style="color: #64748b; font-size: 16px; line-height: 1.7; margin-bottom: 30px;">
                            {{ $heroSettings->hero_description }}
                        </p>

                        <div class="hero-stats mb-4" data-aos="fade-right" data-aos-delay="500">
                            <div class="stat-item">
                                <h3><span data-purecounter-start="0" data-purecounter-end="{{ $mitraCount }}" data-purecounter-duration="2" class="purecounter"></span>+</h3>
                                <p>Mitra Industri</p>
                            </div>
                            <div class="stat-item">
                                <h3><span data-purecounter-start="0" data-purecounter-end="{{ $studentCount }}" data-purecounter-duration="2" class="purecounter"></span>+</h3>
                                <p>Siswa Aktif</p>
                            </div>
                            <div class="stat-item">
                                <h3><span data-purecounter-start="0" data-purecounter-end="{{ $employeeCount }}" data-purecounter-duration="2" class="purecounter"></span>+</h3>
                                <p>Guru & Staf</p>
                            </div>
                        </div>

                        <div class="hero-actions d-flex gap-3 align-items-center" data-aos="fade-right" data-aos-delay="600">
                            <a href="#{{ $profileMenu->slug ?? 'section-profil' }}" class="btn btn-primary btn-lg px-4 py-3" style="border-radius: 8px; font-weight: 600;">Lihat Profil <i class="bi bi-arrow-down ms-2"></i></a>
                            @if(!empty($contact->no_telp))
                                <div class="emergency-contact ms-2 d-none d-sm-flex align-items-center">
                                    <div class="emergency-icon bg-primary-light p-2 rounded-circle me-2" style="background-color: rgba(13, 110, 253, 0.1);">
                                        <i class="bi bi-telephone-fill text-primary" style="font-size: 18px;"></i>
                                    </div>
                                    <div class="emergency-info">
                                        <small class="text-muted d-block" style="font-size: 11px;">Informasi Sekolah</small>
                                        <strong style="font-size: 14px;">{{ $contact->no_telp }}</strong>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mt-5 mt-lg-0">
                    <div class="hero-visual" data-aos="fade-left" data-aos-delay="400">
                        <div class="main-image position-relative">
                            <img src="{{ $heroImageUrl }}" alt="SMKN 1 Talaga" class="img-fluid rounded-4 shadow-lg w-100" style="object-fit: cover; aspect-ratio: 4/3;">
                            <!-- Card 1: PPDB Online (Bottom Left, inside image) -->
                            <div class="floating-card rating-card shadow p-3 rounded-3 bg-white" style="position: absolute; bottom: 20px !important; left: 20px !important; max-width: 220px; z-index: 10; border: 1px solid #f1f5f9;">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="card-icon bg-success-light p-2 rounded-circle" style="background-color: rgba(25, 135, 84, 0.1); width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-patch-check-fill text-success" style="font-size: 18px;"></i>
                                    </div>
                                    <div class="card-content text-start">
                                        <h6 class="m-0" style="font-size: 13px; font-weight: 700;">{{ $heroSettings->badge_1_title }}</h6>
                                        <small class="text-muted" style="font-size: 11px;">{{ $heroSettings->badge_1_subtitle }}</small>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Card 2: 85%+ Terserap (Top Right, pushed down below header) -->
                            <div class="floating-card appointment-card shadow p-3 rounded-3 bg-white" style="position: absolute; top: 120px !important; right: 20px !important; max-width: 180px; z-index: 10; border: 1px solid #f1f5f9;">
                                <div class="card-content text-center">
                                    <div class="rating-stars mb-1 text-warning" style="font-size: 12px;">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                    <h6 class="m-0" style="font-size: 14px; font-weight: 700; color: #1e3a8a;">{{ $heroSettings->badge_2_title }}</h6>
                                    <small class="text-muted" style="font-size: 11px;">{{ $heroSettings->badge_2_subtitle }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Hero Section -->

    @php
        $visionMenu = $menus->firstWhere('slug', 'section-visimisi');
        $profileMenu = $menus->firstWhere('slug', 'section-profil');
        $programMenu = $menus->firstWhere('slug', 'section-konsentrasi');
        $newsMenu = $menus->firstWhere('slug', 'section-berita');
        $extrakurikulerMenu = $menus->firstWhere('slug', 'section-ekskul');
        $galleryMenu = $menus->firstWhere('slug', 'section-gallery');
    @endphp

    <!-- Profil Sekolah Section -->
    @if ($profileMenu)
        @foreach ($profiles as $p)
            @if ($p->menu && $p->menu->id === $profileMenu->id)
                @php
                    $profilePhoto = null;
                    if(!empty($p->photo)) {
                        if (filter_var($p->photo, FILTER_VALIDATE_URL)) {
                            $profilePhoto = $p->photo;
                        } elseif (preg_match('#^assets/#', $p->photo) || preg_match('#^public/#', $p->photo)) {
                            $profilePhoto = asset(preg_replace('#^public/#', '', $p->photo));
                        } else {
                            $rel = preg_replace('#^storage/#', '', $p->photo);
                            $profilePhoto = route('public.files', ['path' => $rel]);
                        }
                    } else {
                        $profilePhoto = $heroImageUrl;
                    }
                @endphp
                <section id="{{ $p->menu->slug }}" class="home-about section" style="background-color: #ffffff; padding: 80px 0;">
                    <div class="container" data-aos="fade-up" data-aos-delay="100">
                        <div class="row align-items-center">
                            <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right" data-aos-delay="300">
                                <div class="about-visual position-relative">
                                    <div class="main-image">
                                        <img src="{{ $profilePhoto }}" alt="Fasilitas SMKN 1 Talaga" class="img-fluid rounded-4 shadow-sm w-100" style="object-fit: cover; aspect-ratio: 4/3;">
                                    </div>
                                    <div class="floating-card bg-white p-3 rounded-3 shadow-sm d-flex align-items-center gap-2" style="position: absolute; bottom: 20px; right: 20px; max-width: 250px; z-index: 10;">
                                        <div class="icon bg-primary-light p-2 rounded-circle" style="background-color: rgba(13, 110, 253, 0.1);">
                                            <i class="bi bi-mortarboard-fill text-primary" style="font-size: 20px;"></i>
                                        </div>
                                        <div class="card-text">
                                            <h6 class="m-0" style="font-size: 14px; font-weight: 700;">{{ $heroSettings->badge_3_title }}</h6>
                                            <small class="text-muted" style="font-size: 11px;">{{ $heroSettings->badge_3_subtitle }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                                <div class="about-content">
                                    <h2 class="section-heading" style="font-size: 32px; font-weight: 700; color: #0f172a; margin-bottom: 20px;">
                                        Profil Singkat <span class="text-primary">SMKN 1 Talaga</span>
                                    </h2>
                                    <div class="profile-container" style="color: #475569; font-size: 15px; line-height: 1.8;">
                                        @php
                                            $plainContent = html_entity_decode(strip_tags($p->content ?? ''), ENT_QUOTES, 'UTF-8');
                                            $plainContent = preg_replace('/\s+/u', ' ', $plainContent);
                                            $plainContent = trim($plainContent);
                                            $cutoff = 350;
                                        @endphp
                                        <p>
                                            {{ \Illuminate\Support\Str::limit($plainContent, $cutoff) }}
                                        </p>
                                        @if (mb_strlen($plainContent) > $cutoff)
                                            <div class="cta-section mt-4">
                                                <a href="{{ route('profiles.show', $p->id) }}" class="btn btn-outline-primary px-4 py-2" style="font-weight: 600; border-radius: 6px;">
                                                    Baca Selengkapnya
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        @endforeach
    @endif

    <!-- Visi & Misi Section -->
    @if ($visionMenu)
        @foreach ($visionmissions as $v)
            @if ($v->menu && $v->menu->id === $visionMenu->id)
                <section id="{{ $v->menu->slug }}" class="section light-background" style="background-color: #f8fafc; padding: 80px 0;">
                    <div class="container" data-aos="fade-up">
                        <div class="text-center mb-5">
                            <h2 style="font-size: 32px; font-weight: 700; color: #0f172a;">Visi & Misi Sekolah</h2>
                            <p class="text-muted">Arah, tujuan, dan ikhtiar SMKN 1 Talaga dalam mewujudkan cita-cita pendidikan.</p>
                        </div>
                        <div class="row g-4 justify-content-center">
                            <!-- Visi -->
                            <div class="col-lg-5" data-aos="fade-up" data-aos-delay="100">
                                <div class="bg-white p-4 rounded-4 shadow-sm h-100 border-top border-primary border-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-primary-light p-2.5 rounded-3 me-3" style="background-color: rgba(13, 110, 253, 0.1);">
                                            <i class="bi bi-eye-fill text-primary" style="font-size: 24px;"></i>
                                        </div>
                                        <h4 class="m-0" style="font-size: 20px; font-weight: 700; color: #0f172a;">Visi</h4>
                                    </div>
                                    <p style="color: #475569; font-size: 15px; line-height: 1.8;">
                                        {{ $v->vision ?? 'Belum ada visi.' }}
                                    </p>
                                </div>
                            </div>
                            <!-- Misi -->
                            <div class="col-lg-7" data-aos="fade-up" data-aos-delay="200">
                                <div class="bg-white p-4 rounded-4 shadow-sm h-100 border-top border-success border-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-success-light p-2.5 rounded-3 me-3" style="background-color: rgba(25, 135, 84, 0.1);">
                                            <i class="bi bi-compass-fill text-success" style="font-size: 24px;"></i>
                                        </div>
                                        <h4 class="m-0" style="font-size: 20px; font-weight: 700; color: #0f172a;">Misi</h4>
                                    </div>
                                    <ol class="ps-3" style="color: #475569; font-size: 14px; line-height: 1.8;">
                                        @foreach (preg_split("/\r\n|\r|\n/", $v->mission ?? '') as $misi)
                                            @php
                                                $cleanMisi = preg_replace('/^\s*\d+\.\s*/', '', $misi);
                                            @endphp
                                            @if (trim($cleanMisi) !== '')
                                                <li class="mb-2">{{ $cleanMisi }}</li>
                                            @endif
                                        @endforeach
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        @endforeach
    @endif

    <!-- Program Keahlian Section -->
    @if ($programMenu)
        @php
            $programs = \DB::table('core_expertise_programs')->orderBy('name')->get();
            $concs = \DB::table('core_expertise_concentrations')->orderBy('name')->get();

            $manualMap = [
                'teknik-otomotif-to' => ['teknik-kendaraan-ringan-tkr', 'teknik-sepeda-motor-tsm'],
                'pemasaran-pn' => ['bisnis-ritel-br'],
            ];

            $assigned = [];
            $groups = [];
            foreach ($programs as $p) {
                $groups[$p->slug] = ['program' => $p, 'subs' => []];
            }

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

                if (!$bestProg) {
                    $bestProg = $programs->first();
                }

                $groups[$bestProg->slug]['subs'][] = $c;
                $assigned[$c->slug] = true;
            }
        @endphp

        <section id="{{ $programMenu->slug }}" class="featured-departments section" style="background-color: #ffffff; padding: 80px 0;">
            <div class="container" data-aos="fade-up">
                <div class="text-center mb-5">
                    <h2 style="font-size: 32px; font-weight: 700; color: #0f172a;">Program & Konsentrasi Keahlian</h2>
                    <p class="text-muted">Membuka kesempatan belajar di berbagai bidang kejuruan unggulan yang relevan dengan kebutuhan dunia kerja.</p>
                </div>

                <div class="row g-4 justify-content-center">
                    @foreach ($groups as $g)
                        @php
                            $p = $g['program'];
                            $subs = $g['subs'];
                        @endphp
                        <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                            <div class="department-highlight shadow-sm p-4 rounded-4 h-100 bg-light border-0 d-flex flex-column justify-content-between" style="transition: all 0.3s ease;">
                                <div>
                                    <div class="highlight-icon bg-primary p-3 rounded-circle text-white d-inline-flex justify-content-center align-items-center mb-4" style="width: 50px; height: 50px;">
                                        <i class="bi bi-mortarboard-fill" style="font-size: 20px;"></i>
                                    </div>
                                    <h4 style="font-size: 18px; font-weight: 700; color: #0f172a; margin-bottom: 15px;">{{ $p->name }}</h4>
                                    <p class="text-muted mb-4" style="font-size: 13px;">Kelompok Program Keahlian unggulan dengan kompetensi yang dikembangkan terarah.</p>
                                </div>
                                <div class="expertise-list mb-3">
                                    <small class="text-muted font-weight-bold mb-2 d-block" style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">Konsentrasi Keahlian:</small>
                                    <ul class="list-unstyled m-0 d-flex flex-column gap-2">
                                        @if (count($subs) === 0)
                                            <li style="font-size: 13px; color: #64748b;">Belum ada konsentrasi terdaftar.</li>
                                        @else
                                            @foreach ($subs as $s)
                                                <li>
                                                    <a href="{{ route('expertise.show', $s->slug) }}" class="text-decoration-none text-dark hover-primary d-flex align-items-center" style="font-size: 13px; font-weight: 500;">
                                                        <i class="bi bi-arrow-right-short text-primary me-1" style="font-size: 16px;"></i>
                                                        {{ $s->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Ekstrakurikuler Section -->
    @if ($extrakurikulerMenu && $extrakurikulers->count() > 0)
        <section id="{{ $extrakurikulerMenu->slug }}" class="section light-background" style="background-color: #f8fafc; padding: 80px 0;">
            <div class="container" data-aos="fade-up">
                <div class="text-center mb-5">
                    <h2 style="font-size: 32px; font-weight: 700; color: #0f172a;">Ekstrakurikuler</h2>
                    <p class="text-muted">Wadah eksplorasi minat, bakat, kepemimpinan, dan kepribadian siswa di luar jam akademik.</p>
                </div>

                <!-- Swiper -->
                <div class="swiper init-swiper" data-aos="fade-up" data-aos-delay="100">
                    <script type="json" class="swiper-config">
                        {
                            "loop": true,
                            "speed": 600,
                            "autoplay": {
                                "delay": 3500
                            },
                            "slidesPerView": "auto",
                            "pagination": {
                                "el": ".swiper-pagination",
                                "type": "bullets",
                                "clickable": true
                            },
                            "breakpoints": {
                                "320": {
                                    "slidesPerView": 1,
                                    "spaceBetween": 20
                                },
                                "768": {
                                    "slidesPerView": 2,
                                    "spaceBetween": 20
                                },
                                "1200": {
                                    "slidesPerView": 3,
                                    "spaceBetween": 20
                                }
                            }
                        }
                    </script>
                    <div class="swiper-wrapper align-items-stretch">
                        @foreach ($extrakurikulers as $item)
                            @php
                                $imgUrl = null;
                                if (!empty($item->photo)) {
                                    if (filter_var($item->photo, FILTER_VALIDATE_URL)) {
                                        $imgUrl = $item->photo;
                                    } elseif (preg_match('#^assets/#', $item->photo) || preg_match('#^public/#', $item->photo)) {
                                        $imgUrl = asset(preg_replace('#^public/#', '', $item->photo));
                                    } else {
                                        $rel = preg_replace('#^storage/#', '', $item->photo);
                                        $imgUrl = route('public.files', ['path' => $rel]);
                                    }
                                } else {
                                    $imgUrl = asset('assets/images/default-extrakurikuler.png');
                                }
                            @endphp
                            <div class="swiper-slide h-auto">
                                <div class="bg-white p-4 rounded-4 shadow-sm h-100 d-flex flex-column justify-content-between border-0" style="transition: transform 0.3s ease;">
                                    <div class="text-center">
                                        <div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 100px; height: 100px; overflow: hidden;">
                                            <img src="{{ $imgUrl }}" alt="{{ $item->name }}" class="img-fluid rounded-3" style="max-height: 100%; object-fit: contain;" onerror="this.src='{{ asset('assets/images/default-extrakurikuler.png') }}'">
                                        </div>
                                        <h5 style="font-size: 18px; font-weight: 700; color: #0f172a; margin-bottom: 10px;">{{ $item->name }}</h5>
                                        <p class="text-muted" style="font-size: 13px; line-height: 1.6;">
                                            "{{ Str::limit($item->description, 100) }}"
                                        </p>
                                    </div>
                                    <div class="text-center mt-3">
                                        <a href="{{ route('ekstrakurikulers.show', $item->id) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                            Selengkapnya
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination mt-4"></div>
                </div>
            </div>
        </section>
    @endif

    <!-- Prestasi Section -->
    @if (isset($achievements) && $achievements->count() > 0)
        <section id="prestasi-sekolah" class="section" style="background-color: #ffffff; padding: 80px 0; border-top: 1px solid #f1f5f9;">
            <div class="container" data-aos="fade-up">
                <div class="text-center mb-5">
                    <h2 style="font-size: 32px; font-weight: 700; color: #0f172a;">Prestasi Siswa & Sekolah</h2>
                    <p class="text-muted">Apresiasi dan dokumentasi berbagai pencapaian prestasi akademik & non-akademik civitas SMKN 1 Talaga.</p>
                </div>

                <!-- Swiper Slider -->
                <div class="swiper init-swiper" data-aos="fade-up" data-aos-delay="100">
                    <script type="json" class="swiper-config">
                        {
                            "loop": true,
                            "speed": 600,
                            "autoplay": {
                                "delay": 4000
                            },
                            "slidesPerView": "auto",
                            "pagination": {
                                "el": ".swiper-pagination",
                                "type": "bullets",
                                "clickable": true
                            },
                            "breakpoints": {
                                "320": {
                                    "slidesPerView": 1,
                                    "spaceBetween": 20
                                },
                                "768": {
                                    "slidesPerView": 2,
                                    "spaceBetween": 25
                                },
                                "1200": {
                                    "slidesPerView": 3,
                                    "spaceBetween": 30
                                }
                            }
                        }
                    </script>
                    <div class="swiper-wrapper align-items-stretch">
                        @foreach ($achievements as $item)
                            @php
                                $photoUrl = $item->photo ? asset($item->photo) : asset('assets/images/default-news.png');
                                $catBadge = 'bg-primary';
                                if ($item->category == 'Non-Akademik') $catBadge = 'bg-purple';
                                elseif ($item->category == 'Olahraga') $catBadge = 'bg-warning text-dark';
                                elseif ($item->category == 'Seni') $catBadge = 'bg-info text-white';
                            @endphp
                            <div class="swiper-slide h-auto">
                                <div class="bg-white p-0 rounded-4 shadow-sm h-100 d-flex flex-column justify-content-between border" style="transition: transform 0.3s ease; border: 1px solid #e2e8f0 !important; overflow: hidden;">
                                    <div>
                                        <div class="position-relative" style="height: 200px; overflow: hidden;">
                                            <img src="{{ $photoUrl }}" alt="{{ $item->title }}" class="w-100 h-100 object-fit-cover" onerror="this.src='{{ asset('assets/images/default-news.png') }}'">
                                            <span class="position-absolute badge {{ $catBadge }} px-3 py-2 shadow-sm" style="font-size: 10px; border-radius: 6px; top: 12px; left: 12px; z-index: 10;">
                                                {{ $item->category }}
                                            </span>
                                        </div>
                                        <div class="p-4">
                                            <div class="d-flex align-items-center text-muted mb-2 gap-3" style="font-size: 11px;">
                                                <div>
                                                    <i class="bi bi-calendar3 me-1 text-primary"></i>
                                                    <span>{{ \Carbon\Carbon::parse($item->date)->locale('id')->isoFormat('D MMM YYYY') }}</span>
                                                </div>
                                            </div>
                                            <h5 style="font-size: 16px; font-weight: 700; color: #0f172a; line-height: 1.4; margin-bottom: 15px; min-height: 44px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                                {{ $item->title }}
                                            </h5>
                                            <div class="d-flex align-items-center gap-2 p-2 rounded bg-light mb-3">
                                                <i class="bi bi-person-fill text-primary" style="font-size: 14px;"></i>
                                                <div style="font-size: 12px;">
                                                    <div class="text-muted" style="font-size: 9px; line-height: 1;">Pemenang</div>
                                                    <div class="fw-bold text-dark">{{ $item->winner_name }}</div>
                                                </div>
                                                @if($item->winner_social)
                                                    <a href="{{ $item->winner_social }}" target="_blank" class="ms-auto text-primary" title="Sosial Media Pemenang">
                                                        <i class="bi bi-instagram" style="font-size: 16px;"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="px-4 pb-4">
                                        <hr class="mt-0 mb-3 text-muted">
                                        <a href="{{ route('public.achievements.show', $item->id) }}" class="btn btn-outline-primary btn-sm w-100 py-2" style="border-radius: 6px; font-weight: 600;">
                                            Detail Selengkapnya
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination mt-4"></div>
                </div>

                <div class="text-center mt-5">
                    <a href="{{ route('public.achievements.index') }}" class="btn btn-primary px-5 py-3 shadow" style="border-radius: 8px; font-weight: 700; font-size: 15px;">
                        Lihat Semua Prestasi <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </section>
    @endif

    <!-- Berita Terkini Section -->
    @if ($newsMenu && $news->count() > 0)
        <section id="{{ $newsMenu->slug }}" class="featured-services section" style="background-color: #ffffff; padding: 80px 0;">
            <div class="container" data-aos="fade-up">
                <div class="text-center mb-5">
                    <h2 style="font-size: 32px; font-weight: 700; color: #0f172a;">Berita & Informasi Terbaru</h2>
                    <p class="text-muted">Ikuti terus berita sekolah, agenda kegiatan, pengumuman, dan artikel edukatif menarik dari kami.</p>
                </div>

                <div class="row g-4">
                    @foreach ($news->take(3) as $item)
                        @php
                            $newsPhoto = null;
                            if (!empty($item->photo)) {
                                $p = $item->photo;
                                if (filter_var($p, FILTER_VALIDATE_URL)) {
                                    $newsPhoto = $p;
                                } elseif (preg_match('#^assets/#', $p) || preg_match('#^public/assets/#', $p)) {
                                    $newsPhoto = asset(preg_replace('#^public/#', '', $p));
                                } else {
                                    $rel = preg_replace('#^storage/#', '', $p);
                                    $newsPhoto = route('public.files', ['path' => $rel]);
                                }
                            } else {
                                if (!empty($item->content) && preg_match('/<img[^>]+src="([^">]+)"/i', $item->content, $matches)) {
                                    $newsPhoto = $matches[1];
                                } else {
                                    $newsPhoto = asset('assets/images/default-news.png');
                                }
                            }

                            // Clean editor markup/spaces for a proper preview
                            $cleanedContent = strip_tags($item->content);
                            $cleanedContent = html_entity_decode($cleanedContent);
                            $cleanedContent = str_replace(["\xc2\xa0", '&nbsp;'], ' ', $cleanedContent);
                            $cleanedContent = preg_replace('/\s+/', ' ', $cleanedContent);
                            $cleanedContent = trim($cleanedContent);
                        @endphp
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                             <div class="bg-white rounded-4 shadow-sm h-100 overflow-hidden d-flex flex-column justify-content-between border" style="transition: transform 0.3s ease;">
                                 <div>
                                     <div class="position-relative" style="height: 200px; overflow: hidden;">
                                         <img src="{{ $newsPhoto }}" alt="{{ $item->title }}" class="w-100 h-100 object-fit-cover" style="transition: transform 0.5s ease;" onerror="this.src='{{ asset('assets/images/default-news.png') }}'">
                                     </div>
                                    <div class="p-4">
                                        <div class="d-flex align-items-center text-muted mb-2" style="font-size: 12px;">
                                            <i class="bi bi-calendar3 me-2 text-primary"></i>
                                            <span>{{ \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}</span>
                                        </div>
                                        @if ($item->category)
                                            <div class="mb-2">
                                                <span class="badge bg-primary text-white" style="font-size: 10px; padding: 4px 8px;">
                                                    {{ $item->category->name }}
                                                </span>
                                            </div>
                                        @endif
                                        <h5 class="line-clamp-2" style="font-size: 16px; font-weight: 700; color: #0f172a; line-height: 1.4; margin-bottom: 10px;">
                                            {{ $item->title }}
                                        </h5>
                                        <p class="text-muted line-clamp-3" style="font-size: 13px; line-height: 1.6;">
                                            {{ Str::limit($cleanedContent, 100, '...') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="px-4 pb-4 mt-auto">
                                    <a href="{{ route('news.show', $item->id) }}" class="btn btn-outline-primary btn-sm w-100 py-2" style="border-radius: 6px; font-weight: 600;">
                                        Baca Artikel
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-5">
                    <a href="{{ route('news.index') }}" class="btn btn-primary px-4 py-2.5" style="border-radius: 8px; font-weight: 600;">
                        Lihat Semua Berita <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </section>
    @endif

    <!-- Mitra Industri Section -->
    @if (!empty($mitras) && $mitras->count() > 0)
        <section class="section light-background" style="background-color: #f8fafc; padding: 60px 0;">
            <div class="container" data-aos="fade-up">
                <div class="text-center mb-4">
                    <h5 class="text-muted font-weight-bold" style="font-size: 14px; text-transform: uppercase; letter-spacing: 1px;">Mitra Industri Kerjasama Kami</h5>
                </div>
                <div class="swiper init-swiper" data-aos="fade-up" data-aos-delay="100">
                    <script type="json" class="swiper-config">
                        {
                            "loop": true,
                            "speed": 800,
                            "autoplay": {
                                "delay": 2000
                            },
                            "slidesPerView": "auto",
                            "breakpoints": {
                                "320": {
                                    "slidesPerView": 2,
                                    "spaceBetween": 30
                                },
                                "576": {
                                    "slidesPerView": 3,
                                    "spaceBetween": 40
                                },
                                "992": {
                                    "slidesPerView": 5,
                                    "spaceBetween": 50
                                }
                            }
                        }
                    </script>
                    <div class="swiper-wrapper align-items-center">
                        @foreach ($mitras as $item)
                            @php
                                $imgUrl = null;
                                if (!empty($item->photo)) {
                                    if (filter_var($item->photo, FILTER_VALIDATE_URL)) {
                                        $imgUrl = $item->photo;
                                    } elseif (preg_match('#^assets/#', $item->photo) || preg_match('#^public/#', $item->photo)) {
                                        $imgUrl = asset(preg_replace('#^public/#', '', $item->photo));
                                    } else {
                                        $rel = preg_replace('#^storage/#', '', $item->photo);
                                        $imgUrl = route('public.files', ['path' => $rel]);
                                    }
                                } else {
                                    $imgUrl = asset('assets/images/default-extrakurikuler.png');
                                }
                            @endphp
                            <div class="swiper-slide text-center d-flex align-items-center justify-content-center" style="height: 100px; width: 150px;">
                                <img src="{{ $imgUrl }}" alt="{{ $item->name }}" class="img-fluid" style="max-height: 60px; filter: grayscale(100%); transition: all 0.3s;" onmouseover="this.style.filter='none'" onmouseout="this.style.filter='grayscale(100%)'">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Galeri Section -->
    @if (!empty($galleries) && $galleries->count() > 0)
        @php
            $sectionId = $galleryMenu->slug ?? 'section-gallery';
            $photos = $galleries->where('type', 'photo')->take(4);
            $videos = $galleries->where('type', 'video')->take(2);
        @endphp
        <section id="{{ $sectionId }}" class="section" style="background-color: #ffffff; padding: 80px 0;">
            <div class="container" data-aos="fade-up">
                <div class="text-center mb-5">
                    <h2 style="font-size: 32px; font-weight: 700; color: #0f172a;">Galeri Sekolah</h2>
                    <p class="text-muted">Dokumentasi momen berharga, fasilitas sekolah, prestasi siswa, dan berbagai acara penting.</p>
                </div>

                <div class="row g-4">
                    <!-- Foto Grid -->
                    @foreach ($photos as $item)
                        @php
                            $imgUrl = null;
                            if (!empty($item->file_path)) {
                                $imgUrl = asset($item->file_path);
                            } elseif ($item->embed_html && preg_match('/src="([^"]+)"/i', $item->embed_html, $matches)) {
                                $imgUrl = $matches[1];
                            } else {
                                $imgUrl = asset('assets/images/default-news.png');
                            }
                        @endphp
                        <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                            <div class="position-relative overflow-hidden rounded-4 shadow-sm" style="aspect-ratio: 1/1; cursor: pointer;">
                                <a href="{{ $imgUrl }}" class="glightbox" data-gallery="gallery-images" data-title="{{ $item->title }}">
                                    <img src="{{ $imgUrl }}" alt="{{ $item->title }}" class="w-100 h-100 object-fit-cover hover-scale" style="transition: all 0.5s;" onerror="this.src='{{ asset('assets/images/default-news.png') }}'">
                                    <div class="overlay d-flex flex-column justify-content-end p-3 text-white position-absolute w-100 h-100" style="bottom: 0; left: 0; background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, transparent 100%);">
                                        <h6 class="m-0" style="font-size: 14px; font-weight: 600;">{{ $item->title }}</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach

                    <!-- Video Grid -->
                    @foreach ($videos as $item)
                        <div class="col-lg-6 col-md-12" data-aos="zoom-in" data-aos-delay="200">
                            <div class="position-relative overflow-hidden rounded-4 shadow-sm bg-light" style="aspect-ratio: 16/9;">
                                @if($item->embed_html)
                                    {!! preg_replace('/width="\d+"/', 'width="100%"', preg_replace('/height="\d+"/', 'height="100%"', $item->embed_html)) !!}
                                @endif
                                <div class="p-3 text-white position-absolute w-100" style="bottom: 0; left: 0; background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, transparent 100%); pointer-events: none;">
                                    <h6 class="m-0" style="font-size: 14px; font-weight: 600;">{{ $item->title }}</h6>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-5">
                    @if (Route::has('galleries.index'))
                        <a href="{{ route('galleries.index') }}" class="btn btn-primary px-4 py-2.5" style="border-radius: 8px; font-weight: 600;">
                            Lihat Semua Galeri <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    @endif
                </div>
            </div>
        </section>
    @endif

@endsection

@push('scripts')
    <style>
        .hover-scale:hover {
            transform: scale(1.08);
        }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endpush
