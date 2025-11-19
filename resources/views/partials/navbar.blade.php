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
                    <a href="/#home"
                        class="text-15 hover:text-custom-500 [&.active]:text-custom-500 dark:hover:text-custom-500 dark:[&.active]:text-custom-500 active block px-4 py-2.5 font-medium text-slate-800 transition-all duration-300 ease-linear md:inline-block md:px-3 md:py-0.5 dark:text-zinc-200">Home</a>
                </li>
                @foreach ($menus as $m)
                    <li><a class="text-15 hover:text-custom-500 [&.active]:text-custom-500 dark:hover:text-custom-500 dark:[&.active]:text-custom-500 block px-4 py-2.5 font-medium text-slate-800 transition-all duration-300 ease-linear md:inline-block md:px-3 md:py-0.5 dark:text-zinc-200"
                            href="/#{{ $m->slug }}">
                            {{ $m->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="ml-auto md:hidden">
            <button id="navbar-toggle" aria-expanded="false" aria-controls="navbar7" type="button"
                class="inline-flex items-center justify-center rounded p-2 text-slate-700 hover:bg-slate-100">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 6H20" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                    <path d="M4 12H20" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                    <path d="M4 18H20" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                </svg>
            </button>
        </div>
    </div>
</nav>

<script>
    (function() {
        var btn = document.getElementById('navbar-toggle');
        var menu = document.getElementById('navbar7');
        if (!btn || !menu) return;
        btn.addEventListener('click', function() {
            var expanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', expanded ? 'false' : 'true');
            if (menu.classList.contains('hidden')) {
                menu.classList.remove('hidden');
            } else {
                menu.classList.add('hidden');
            }
        });
        // close menu when a link is clicked (mobile)
        menu.querySelectorAll('a').forEach(function(link) {
            link.addEventListener('click', function() {
                if (window.innerWidth < 768) {
                    menu.classList.add('hidden');
                    btn.setAttribute('aria-expanded', 'false');
                }
            });
        });
    })();
</script>
