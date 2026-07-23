@php
    $menus = $menus ?? \App\Models\S_Menu::with('submenus')->get();
    // Definisikan urutan menu yang diinginkan
    $menuOrder = ['Profil Sekolah', 'Berita', 'Program Keahlian', 'Ekstrakurikuler', 'Prestasi', 'Kontak'];

    // Pisahkan menu berdasarkan urutan
    $orderedMenus = [];
    $otherMenus = [];

    foreach ($menus as $m) {
        $position = array_search($m->name, $menuOrder);
        if ($position !== false) {
            $orderedMenus[$position] = $m;
        } else {
            $otherMenus[] = $m;
        }
    }

    // Sort ordered menus berdasarkan key
    ksort($orderedMenus);

    // Gabungkan: ordered menus + other menus (menu lain muncul setelah Kontak)
    $sortedMenus = array_merge($orderedMenus, $otherMenus);
    $contact = $contact ?? \App\Models\S_Contact::first();
@endphp

<header id="header" class="header fixed-top">

    <div class="topbar d-flex align-items-center dark-background">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                @if($contact && !empty($contact->email))
                    <i class="bi bi-envelope d-flex align-items-center">
                        <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                    </i>
                @else
                    <i class="bi bi-envelope d-flex align-items-center">
                        <a href="mailto:info@smkn1talaga.sch.id">info@smkn1talaga.sch.id</a>
                    </i>
                @endif

                @if($contact && !empty($contact->no_telp))
                    <i class="bi bi-phone d-flex align-items-center ms-4">
                        <span>{{ $contact->no_telp }}</span>
                    </i>
                @else
                    <i class="bi bi-phone d-flex align-items-center ms-4">
                        <span>(0262) 123456</span>
                    </i>
                @endif
            </div>
            <div class="social-links d-none d-md-flex align-items-center">
                <a href="https://www.facebook.com/smkn1tlg/" class="facebook" target="_blank"><i class="bi bi-facebook"></i></a>
                <a href="https://www.instagram.com/smkn1tlg" class="instagram" target="_blank"><i class="bi bi-instagram"></i></a>
                <a href="https://youtube.com/@smkn1tlg" class="youtube" target="_blank"><i class="bi bi-youtube"></i></a>
            </div>
        </div>
    </div><!-- End Top Bar -->

    <div class="branding d-flex align-items-center">

        <div class="container position-relative d-flex align-items-center justify-content-between">
            <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto" style="flex-shrink: 0;">
                <img src="{{ asset('assets/images/logosmk.png') }}" alt="Logo SMKN 1 Talaga" style="max-height: 40px; margin-right: 10px;">
                <h1 class="sitename" style="font-size: 22px; font-weight: 700; color: #1e3a8a; margin: 0; letter-spacing: 0.5px; white-space: nowrap;">SMKN 1 Talaga</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="{{ url('/#home') }}">Home</a></li>

                    @foreach ($sortedMenus as $m)
                        @if ($m->submenus && $m->submenus->count() > 0)
                            <li class="dropdown">
                                @php
                                    $isExternalLink = preg_match('/^(https?:\/\/|\/)/', $m->slug);
                                    $menuUrl = $isExternalLink ? $m->slug : url('/#' . $m->slug);
                                @endphp
                                <a href="{{ $menuUrl }}">
                                    <span>{{ $m->name }}</span>
                                    <i class="bi bi-chevron-down toggle-dropdown"></i>
                                </a>
                                <ul>
                                    @foreach ($m->submenus as $submenu)
                                        <li>
                                            @php
                                                $submenuUrl = '#';
                                                $isSubmenuExternal = false;

                                                if (!empty($submenu->url) && preg_match('/^https?:\/\//', $submenu->url)) {
                                                    $submenuUrl = $submenu->url;
                                                    $isSubmenuExternal = true;
                                                } elseif (!empty($submenu->external_url) && preg_match('/^https?:\/\//', $submenu->external_url)) {
                                                    $submenuUrl = $submenu->external_url;
                                                    $isSubmenuExternal = true;
                                                } elseif ($m->slug === 'section-konsentrasi') {
                                                    $concentrations = $concentrations ?? \DB::table('core_expertise_concentrations')->get();
                                                    $match = $concentrations->first(function($c) use ($submenu) {
                                                        $cSlug = \Illuminate\Support\Str::slug($c->name);
                                                        $sSlug = \Illuminate\Support\Str::slug($submenu->name);
                                                        return \Illuminate\Support\Str::contains($cSlug, $sSlug) || \Illuminate\Support\Str::contains($sSlug, $cSlug);
                                                    });
                                                    if ($match) {
                                                        $submenuUrl = route('expertise.show', $match->slug);
                                                    } else {
                                                        $submenuUrl = url('sub/' . $submenu->url);
                                                    }
                                                } elseif (isset($submenu->type)) {
                                                    if ($submenu->type === 'url') {
                                                        $submenuUrl = $submenu->external_url;
                                                        $isSubmenuExternal = preg_match('/^https?:\/\//', $submenuUrl);
                                                    } elseif ($submenu->type === 'module') {
                                                        switch ($submenu->module_name) {
                                                            case 'news':
                                                                $submenuUrl = route('news.index');
                                                                break;
                                                            case 'gallery':
                                                                $submenuUrl = route('galleries.index');
                                                                break;
                                                            case 'profil':
                                                                $submenuUrl = url('/#section-profil');
                                                                break;
                                                            case 'visi-misi':
                                                                $submenuUrl = url('/#section-visimisi');
                                                                break;
                                                            case 'expertise':
                                                                $submenuUrl = url('/#section-konsentrasi');
                                                                break;
                                                            case 'ekskul':
                                                                $submenuUrl = url('/#section-ekskul');
                                                                break;
                                                            case 'contact':
                                                                $submenuUrl = url('/#section-kontak');
                                                                break;
                                                            default:
                                                                $submenuUrl = url('/');
                                                        }
                                                    } else {
                                                        $submenuUrl = url('sub/' . $submenu->url);
                                                    }
                                                } else {
                                                    if ($submenu->redirectTo && !empty($submenu->redirectTo->slug)) {
                                                        $submenuUrl = $submenu->redirectTo->slug;
                                                        $isSubmenuExternal = preg_match('/^https?:\/\//', $submenuUrl);
                                                    } else {
                                                        $isSubmenuExternal = preg_match('/^https?:\/\//', $submenu->url);
                                                        $submenuUrl = $isSubmenuExternal ? $submenu->url : url('sub/' . $submenu->url);
                                                    }
                                                }
                                            @endphp
                                            <a href="{{ $submenuUrl }}" @if ($isSubmenuExternal) target="_blank" rel="noopener noreferrer" @endif>
                                                {{ $submenu->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            @php
                                $isExternalLink = preg_match('/^(https?:\/\/|\/)/', $m->slug);
                                $menuUrl = $isExternalLink ? $m->slug : url('/#' . $m->slug);
                            @endphp
                            <li>
                                <a href="{{ $menuUrl }}" @if ($isExternalLink) target="_blank" rel="noopener noreferrer" @endif>
                                    {{ $m->name }}
                                </a>
                            </li>
                        @endif
                    @endforeach

                    @auth
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="btn-dashboard mx-3 my-2 px-3 py-2 text-white bg-primary rounded-2 text-center d-block d-lg-inline-block ms-lg-3" style="font-size: 14px;">
                                <i class="bi bi-speedometer2 me-1"></i> Dashboard
                            </a>
                        </li>
                    @endauth
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

        </div>
    </div>

</header>
