<nav class="navbar fixed inset-x-0 top-0 z-50 flex h-20 items-center justify-center border-b border-slate-200 py-3 dark:border-zinc-800 [&.is-sticky]:bg-white [&.is-sticky]:shadow-lg [&.is-sticky]:shadow-slate-200/25 dark:[&.is-sticky]:bg-zinc-900 dark:[&.is-sticky]:shadow-zinc-700/30"
    id="navbar">
    <div class="container mx-auto flex w-full items-center self-center px-4 2xl:max-w-[87.5rem]">
        <div class="shrink-0">
            <a href="#!">
                <img src="{{ asset('assets/images/logosmk.png') }}" alt="" class="block h-12 dark:hidden">
                <img src="{{ asset('assets/images/logosmk.png') }}" alt="" class="hidden h-12 dark:block">
            </a>
        </div>

        <div class="mx-auto">
            <ul id="navbar7"
                class="navbar-menu absolute inset-x-0 top-full z-20 mt-px hidden items-center rounded-b-md bg-white py-3 shadow-lg md:relative md:top-auto md:z-0 md:mt-0 md:flex md:rounded-none md:bg-transparent md:py-0 md:shadow-none ltr:ml-auto rtl:mr-auto dark:bg-zinc-800 dark:md:bg-transparent">
                <li>
                    <a href="{{ url('/#home') }}"
                        class="nav-link text-15 hover:text-custom-500 [&.active]:text-custom-500 dark:hover:text-custom-500 dark:[&.active]:text-custom-500 block px-4 py-2.5 font-medium text-slate-800 transition-all duration-300 ease-linear md:inline-block md:px-3 md:py-0.5 dark:text-zinc-200">Home</a>
                </li>

                @php
                    // Definisikan urutan menu yang diinginkan
                    $menuOrder = ['Profil Sekolah', 'Berita', 'Program Keahlian', 'Ekstrakurikuler', 'Kontak'];

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
                @endphp

                {{-- Tampilkan semua menu dengan urutan yang benar --}}
                @foreach ($sortedMenus as $m)
                    <li class="dropdown relative">
                        @if ($m->submenus && $m->submenus->count() > 0)
                            <!-- Menu dengan Submenu (Split Dropdown Button) -->
                            <div class="flex items-center justify-between md:justify-start md:gap-0">
                                @php
                                    // Cek apakah slug dimulai dengan http:// atau https://
                                    $isExternalLink = preg_match('/^https?:\/\//', $m->slug);
                                    $menuUrl = $isExternalLink ? $m->slug : url('/#' . $m->slug);
                                @endphp

                                <a href="{{ $menuUrl }}"
                                    @if ($isExternalLink) target="_blank" rel="noopener noreferrer" @endif
                                    class="nav-link text-15 hover:text-custom-500 [&.active]:text-custom-500 dark:hover:text-custom-500 dark:[&.active]:text-custom-500 block px-4 py-2.5 font-medium text-slate-800 transition-all duration-300 ease-linear md:inline-block md:px-3 md:py-0.5 dark:text-zinc-200">
                                    {{ $m->name }}
                                </a>
                                <button type="button"
                                    class="dropdown-toggle-custom hover:text-custom-500 dark:hover:text-custom-500 mr-2 flex items-center justify-center p-0 text-slate-800 transition-all duration-300 md:h-auto md:px-0 md:py-0.5 dark:text-zinc-200">
                                    <i data-lucide="chevron-down" class="inline-block size-4"></i>
                                </button>
                            </div>

                            <!-- Dropdown Menu -->
                            <ul
                                class="dropdown-menu-custom absolute z-[1000] mt-2 hidden min-w-[10rem] list-none rounded-md bg-white py-2 text-left shadow-lg dark:bg-zinc-600">
                                @foreach ($m->submenus as $submenu)
                                    <li>
                                        @php
                                            // Cek apakah URL submenu adalah external link
                                            $isSubmenuExternal = preg_match('/^https?:\/\//', $submenu->url);
                                            $submenuUrl = $isSubmenuExternal
                                                ? $submenu->url
                                                : url('sub/' . $submenu->url);
                                        @endphp

                                        <a href="{{ $submenuUrl }}"
                                            @if ($isSubmenuExternal) target="_blank" rel="noopener noreferrer" @endif
                                            class="dropdown-item hover:text-custom-500 dark:hover:text-custom-500 block whitespace-nowrap bg-transparent px-4 py-2 font-normal text-slate-600 hover:bg-slate-100 dark:text-zinc-100 dark:hover:bg-zinc-500">
                                            {{ $submenu->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <!-- Menu Biasa (Tanpa Submenu) -->
                            @php
                                // Cek apakah slug dimulai dengan http:// atau https://
                                $isExternalLink = preg_match('/^https?:\/\//', $m->slug);
                                $menuUrl = $isExternalLink ? $m->slug : url('/#' . $m->slug);
                            @endphp

                            <a href="{{ $menuUrl }}"
                                @if ($isExternalLink) target="_blank" rel="noopener noreferrer" @endif
                                class="nav-link text-15 hover:text-custom-500 [&.active]:text-custom-500 dark:hover:text-custom-500 dark:[&.active]:text-custom-500 block px-4 py-2.5 font-medium text-slate-800 transition-all duration-300 ease-linear md:inline-block md:px-3 md:py-0.5 dark:text-zinc-200">
                                {{ $m->name }}
                            </a>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="navbar-toggale-button md:hidden ltr:ml-auto rtl:mr-auto">
            <button type="button"
                class="btn bg-custom-500 border-custom-500 hover:bg-custom-600 hover:border-custom-600 focus:bg-custom-600 focus:border-custom-600 focus:ring-custom-100 active:bg-custom-600 active:border-custom-600 active:ring-custom-100 dark:ring-custom-400/20 flex size-[37.5px] items-center justify-center p-0 text-white hover:text-white focus:text-white focus:ring active:text-white active:ring">
                <i data-lucide="menu"></i>
            </button>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ========================================
        // CUSTOM DROPDOWN HANDLER UNTUK MUNCUL KE KIRI
        // ========================================
        const dropdowns = document.querySelectorAll('.dropdown');

        dropdowns.forEach(dropdown => {
            const toggle = dropdown.querySelector('.dropdown-toggle-custom');
            const menu = dropdown.querySelector('.dropdown-menu-custom');

            if (toggle && menu) {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    // Close dropdown lain
                    document.querySelectorAll('.dropdown-menu-custom').forEach(m => {
                        if (m !== menu) {
                            m.classList.add('hidden');
                        }
                    });

                    // Toggle current dropdown
                    const isHidden = menu.classList.contains('hidden');
                    menu.classList.toggle('hidden');

                    // PAKSA POSISI KE KIRI
                    if (isHidden) {
                        // Reset positioning
                        menu.style.left = 'auto';
                        menu.style.right = '0';
                        menu.style.transform = 'none';
                    }
                });
            }
        });

        // Close dropdown saat klik di luar
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.dropdown')) {
                document.querySelectorAll('.dropdown-menu-custom').forEach(menu => {
                    menu.classList.add('hidden');
                });
            }
        });

        // Fungsi untuk update active state
        function updateActiveMenu() {
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('.nav-link');

            let currentSection = '';

            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;

                if (window.scrollY >= (sectionTop - 100)) {
                    currentSection = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                const href = link.getAttribute('href');

                // Hanya aktifkan untuk link internal (bukan external)
                if (href && href.includes('#') && href === '#' + currentSection) {
                    link.classList.add('active');
                }
            });
        }

        // Update saat scroll
        window.addEventListener('scroll', updateActiveMenu);

        // Update saat page load
        updateActiveMenu();

        // Update saat klik menu (hanya untuk internal link)
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function() {
                const href = this.getAttribute('href');
                // Hanya update active untuk internal link
                if (href && href.includes('#')) {
                    document.querySelectorAll('.nav-link').forEach(l => l.classList.remove(
                        'active'));
                    this.classList.add('active');
                }
            });
        });
    });
</script>
