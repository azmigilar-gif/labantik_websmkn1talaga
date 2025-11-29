<header id="page-topbar"
    class="ltr:md:left-vertical-menu rtl:md:right-vertical-menu group-data-[sidebar-size=md]:ltr:md:left-vertical-menu-md group-data-[sidebar-size=md]:rtl:md:right-vertical-menu-md group-data-[sidebar-size=sm]:ltr:md:left-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:md:right-vertical-menu-sm group/topbar fixed left-0 right-0 z-[1000] transition-all duration-300 ease-linear group-data-[navbar=scroll]:absolute group-data-[layout=horizontal]:z-[1004] group-data-[navbar=bordered]:m-4 group-data-[navbar=hidden]:hidden group-data-[layout=horizontal]:ltr:left-0 group-data-[layout=horizontal]:rtl:right-0 print:hidden group-data-[navbar=bordered]:[&.is-sticky]:mt-0">
    <div class="layout-width">
        <div
            class="bg-topbar border-topbar group-data-[topbar=dark]:bg-topbar-dark group-data-[topbar=dark]:border-topbar-dark group-data-[topbar=brand]:bg-topbar-brand group-data-[topbar=brand]:border-topbar-brand h-header group-data-[topbar=dark]:dark:bg-zink-700 group-data-[topbar=dark]:dark:border-zink-700 group-data-[topbar=dark]:group-[.is-sticky]/topbar:dark:shadow-zink-500 mx-auto flex items-center border-b-2 px-4 shadow-md shadow-slate-200/50 group-data-[navbar=bordered]:rounded-md group-data-[layout=horizontal]:group-data-[navbar=bordered]:rounded-b-none group-data-[layout=horizontal]:shadow-none group-data-[navbar=bordered]:shadow-none group-data-[navbar=bordered]:group-[.is-sticky]/topbar:rounded-t-none dark:shadow-none group-data-[layout=horizontal]:dark:group-[.is-sticky]/topbar:shadow-none group-data-[topbar=dark]:group-[.is-sticky]/topbar:dark:shadow-md">
            <div
                class="navbar-header flex w-full items-center group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:ltr:xl:pr-3 group-data-[layout=horizontal]:rtl:xl:pl-3">
                <!-- LOGO -->
                <div
                    class="h-header group-data-[layout=horizontal]:ltr::pl-0 hidden items-center justify-center px-5 text-center group-data-[layout=horizontal]:md:flex group-data-[layout=horizontal]:rtl:pr-0">

                    <a href="index.html">
                        <span class="hidden">
                            <img src="assets/images/logo.png" alt="" class="mx-auto h-6">
                        </span>
                        <span class="group-data-[topbar=brand]:hidden group-data-[topbar=dark]:hidden">
                            <img src="assets/images/logo-dark.png" alt="" class="mx-auto h-6">
                        </span>
                    </a>
                    <a href="index.html" class="hidden group-data-[topbar=brand]:block group-data-[topbar=dark]:block">
                        <span class="group-data-[topbar=brand]:hidden group-data-[topbar=dark]:hidden">
                            <img src="assets/images/logo.png" alt="" class="mx-auto h-6">
                        </span>
                        <span class="group-data-[topbar=brand]:block group-data-[topbar=dark]:block">
                            <img src="assets/images/logo-light.png" alt="" class="mx-auto h-6">
                        </span>
                    </a>
                </div>
                <button type="button"
                    class="text-topbar-item bg-topbar btn group-data-[topbar=dark]:bg-topbar-dark group-data-[topbar=dark]:border-topbar-dark group-data-[topbar=dark]:text-topbar-item-dark group-data-[topbar=dark]:hover:bg-topbar-item-bg-hover-dark group-data-[topbar=dark]:hover:text-topbar-item-hover-dark group-data-[topbar=brand]:bg-topbar-brand group-data-[topbar=brand]:border-topbar-brand group-data-[topbar=brand]:text-topbar-item-brand group-data-[topbar=brand]:hover:bg-topbar-item-bg-hover-brand group-data-[topbar=brand]:hover:text-topbar-item-hover-brand group-data-[topbar=dark]:dark:bg-zink-700 group-data-[topbar=dark]:dark:text-zink-200 group-data-[topbar=dark]:dark:border-zink-700 group-data-[topbar=dark]:dark:hover:bg-zink-600 group-data-[topbar=dark]:dark:hover:text-zink-50 hamburger-icon relative inline-flex h-[37.5px] w-[37.5px] items-center justify-center rounded-md p-0 transition-all duration-75 ease-linear hover:bg-slate-100 group-data-[layout=horizontal]:flex group-data-[layout=horizontal]:md:hidden"
                    id="topnav-hamburger-icon">
                    <i data-lucide="chevrons-left" class="h-5 w-5 group-data-[sidebar-size=sm]:hidden"></i>
                    <i data-lucide="chevrons-right" class="hidden h-5 w-5 group-data-[sidebar-size=sm]:block"></i>
                </button>

                <div class="ms-auto flex gap-3">

                    <div class="dropdown h-header relative flex items-center">
                        <button type="button"
                            class="bg-topbar text-topbar-item dropdown-toggle btn hover:bg-topbar-item-bg-hover hover:text-topbar-item-hover group-data-[topbar=dark]:text-topbar-item-dark group-data-[topbar=dark]:bg-topbar-dark group-data-[topbar=dark]:hover:bg-topbar-item-bg-hover-dark group-data-[topbar=dark]:hover:text-topbar-item-hover-dark group-data-[topbar=brand]:bg-topbar-brand group-data-[topbar=brand]:hover:bg-topbar-item-bg-hover-brand group-data-[topbar=brand]:hover:text-topbar-item-hover-brand group-data-[topbar=dark]:dark:bg-zink-700 group-data-[topbar=dark]:dark:hover:bg-zink-600 group-data-[topbar=brand]:text-topbar-item-brand group-data-[topbar=dark]:dark:hover:text-zink-50 group-data-[topbar=dark]:dark:text-zink-200 inline-block rounded-full p-0 transition-all duration-200 ease-linear"
                            id="dropdownMenuButton" data-bs-toggle="dropdown">
                            <div class="rounded-full bg-pink-100">
                                <img src="{{ asset('assets/images/user_icon.png') }}" alt=""
                                    class="h-[37.5px] w-[37.5px] rounded-full">
                            </div>
                        </button>
                        <div class="dropdown-menu dark:bg-zink-600 absolute !top-4 z-50 hidden min-w-[14rem] rounded-md bg-white p-4 shadow-md ltr:text-left rtl:text-right"
                            aria-labelledby="dropdownMenuButton">
                            <h6 class="dark:text-zink-300 mb-2 text-sm font-normal text-slate-500">
                                Welcome to Web Pengelola Website Sekolah
                            </h6>
                            <a href="#!" class="mb-3 flex gap-3">
                                <div class="relative inline-block shrink-0">
                                    <div class="rounded-full bg-slate-100">
                                        <img src="{{ asset('assets/images/user_icon.png') }}" alt=""
                                            class="h-12 w-12 rounded-full" />
                                    </div>
                                    <span
                                        class="dark:border-zink-600 absolute -top-1 h-2.5 w-2.5 rounded-full border-2 border-white bg-green-400 ltr:-right-1 rtl:-left-1"></span>
                                </div>
                                <div>
                                    <h6 class="text-15 mb-1">{{ Auth::user()->name }}</h6>
                                    <p class="text-slate-500 dark:text-zinc-300">
                                        {{ Auth::user()->roles->first()->name }}
                                    </p>

                                </div>
                            </a>
                            <ul>
                                <li class="dark:border-zink-500 mt-2 border-t border-slate-200 pt-2">
                                    <form action="{{ route('logout') }}" method="POST" class="w-full">
                                        @csrf
                                        <button type="submit"
                                            class="dropdown-item hover:text-custom-500 focus:text-custom-500 dark:text-zink-200 dark:hover:text-custom-500 dark:focus:text-custom-500 block w-full cursor-pointer border-none bg-transparent py-1.5 text-left text-base font-medium text-slate-600 transition-all duration-200 ease-linear ltr:pr-4 rtl:pl-4">
                                            <i data-lucide="log-out" class="inline-block size-4 ltr:mr-2 rtl:ml-2"></i>
                                            Sign Out
                                        </button>
                                    </form>
                                </li>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
