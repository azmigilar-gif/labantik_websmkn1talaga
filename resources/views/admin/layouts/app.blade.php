{{-- ini app --}}
<!DOCTYPE html>

<html lang="en" class="light group scroll-smooth" data-layout="vertical" data-sidebar="light" data-sidebar-size="lg"
    data-mode="light" data-topbar="light" data-skin="default" data-navbar="sticky" data-content="fluid" dir="ltr">
@include('admin.layouts.head')

<body
    class="bg-body-bg text-body font-public dark:text-zink-100 dark:bg-zink-800 group-data-[skin=bordered]:bg-body-bordered group-data-[skin=bordered]:dark:bg-zink-700 text-base">
    <div class="group-data-[sidebar-size=sm]:min-h-sm group-data-[sidebar-size=sm]:relative">
       <div id="sidebar-overlay" class="fixed inset-0 z-[1002] bg-slate-900/50 hidden"></div>

        @include('admin.partials.sidebar')
        @include('admin.partials.navbar')
        <div class="group-data-[sidebar-size=sm]:min-h-sm relative min-h-screen">
            @yield('content')
            @include('admin.partials.footer')
        </div>
    </div>
    <div class="h-header fixed bottom-6 right-12 hidden items-center group-data-[navbar=hidden]:flex">
        <button data-drawer-target="customizerButton" type="button"
            class="inline-flex h-12 w-12 items-center justify-center rounded-md bg-sky-500 p-0 text-sky-50 shadow-lg transition-all duration-200 ease-linear">
            <i data-lucide="settings" class="inline-block h-5 w-5"></i>
        </button>
    </div>

    <div id="customizerButton" drawer-end=""
        class="z-drawer show dark:bg-zink-600 fixed inset-y-0 flex w-full transform flex-col bg-white shadow transition-transform duration-300 ease-in-out md:w-96 ltr:right-0 rtl:left-0">
        <div class="dark:border-zink-500 flex justify-between border-b border-slate-200 p-4">
            <div class="grow">
                <h5 class="text-16 mb-1">starcode Theme Customizer</h5>
                <p class="dark:text-zink-200 font-normal text-slate-500">Choose your themes & layouts etc.</p>
            </div>
            <div class="shrink-0">
                <button data-drawer-close="customizerButton"
                    class="dark:text-zink-200 dark:hover:text-zink-50 text-slate-500 transition-all duration-150 ease-linear hover:text-slate-800"><i
                        data-lucide="x" class="h-4 w-4"></i></button>
            </div>
        </div>
        <div class="h-full overflow-y-auto p-6">
            <div>
                <h5 class="text-15 mb-3 capitalize underline">Choose Layouts</h5>
                <div class="mb-5 grid grid-cols-1 gap-7 sm:grid-cols-2">
                    <div class="relative">
                        <input id="layout-one" name="dataLayout"
                            class="vertical-menu-btn checked:bg-custom-500 checked:border-custom-500 dark:bg-zink-400 dark:border-zink-500 absolute top-2 h-4 w-4 cursor-pointer appearance-none rounded-full border border-slate-300 bg-slate-100 ltr:right-2 rtl:left-2"
                            type="radio" value="vertical" checked="">
                        <label
                            class="dark:border-zink-500 block h-24 w-full cursor-pointer overflow-hidden rounded-lg border border-slate-200 p-0"
                            for="layout-one">
                            <span class="flex h-full gap-0">
                                <span class="shrink-0">
                                    <span
                                        class="dark:border-zink-500 flex h-full flex-col gap-1 border-slate-200 p-1 ltr:border-r rtl:border-l">
                                        <span class="dark:bg-zink-400 mb-2 block rounded bg-slate-100 p-1 px-2"></span>
                                        <span class="dark:bg-zink-500 block bg-slate-100 p-1 px-2 pb-0"></span>
                                        <span class="dark:bg-zink-500 block bg-slate-100 p-1 px-2 pb-0"></span>
                                        <span class="dark:bg-zink-500 block bg-slate-100 p-1 px-2 pb-0"></span>
                                    </span>
                                </span>
                                <span class="grow">
                                    <span class="flex h-full flex-col">
                                        <span class="dark:bg-zink-500 block h-3 bg-slate-100"></span>
                                        <span class="dark:bg-zink-500 mt-auto block h-3 bg-slate-100"></span>
                                    </span>
                                </span>
                            </span>
                        </label>
                        <h5 class="text-15 mt-2 text-center">Vertical</h5>
                    </div>

                    <div class="relative">
                        <input id="layout-two" name="dataLayout"
                            class="vertical-menu-btn checked:bg-custom-500 checked:border-custom-500 dark:bg-zink-400 dark:border-zink-500 absolute top-2 h-4 w-4 cursor-pointer appearance-none rounded-full border border-slate-300 bg-slate-100 ltr:right-2 rtl:left-2"
                            type="radio" value="horizontal">
                        <label
                            class="dark:border-zink-500 block h-24 w-full cursor-pointer overflow-hidden rounded-lg border border-slate-200 p-0"
                            for="layout-two">
                            <span class="flex h-full flex-col gap-1">
                                <span class="dark:bg-zink-500 flex items-center gap-1 bg-slate-100 p-1">
                                    <span class="dark:bg-zink-500 ml-1 block rounded bg-white p-1"></span>
                                    <span class="dark:bg-zink-500 ms-auto block bg-white p-1 px-2 pb-0"></span>
                                    <span class="dark:bg-zink-500 block bg-white p-1 px-2 pb-0"></span>
                                </span>
                                <span class="dark:bg-zink-500 block bg-slate-100 p-1"></span>
                                <span class="dark:bg-zink-500 mt-auto block bg-slate-100 p-1"></span>
                            </span>
                        </label>
                        <h5 class="text-15 mt-2 text-center">Horizontal</h5>
                    </div>
                </div>

                <div id="semi-dark">
                    <div class="flex items-center">
                        <div class="relative mr-2 inline-block w-10 align-middle transition duration-200 ease-in">
                            <input type="checkbox" name="customDefaultSwitch" value="dark" id="customDefaultSwitch"
                                class="peer/published checked:border-custom-500 arrow-none dark:border-zink-500 dark:bg-zink-500 dark:checked:bg-zink-400 absolute block h-5 w-5 cursor-pointer appearance-none rounded-full border-2 border-slate-200 bg-white/80 transition duration-300 ease-linear checked:right-0 checked:bg-white checked:bg-none">
                            <label for="customDefaultSwitch"
                                class="peer-checked/published:bg-custom-500 peer-checked/published:border-custom-500 dark:border-zink-500 dark:bg-zink-600 block h-5 cursor-pointer overflow-hidden rounded-full border border-slate-200 bg-slate-200 transition duration-300 ease-linear"></label>
                        </div>
                        <label for="customDefaultSwitch" class="inline-block text-base font-medium">Semi Dark (Sidebar &
                            Header)</label>
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <!-- data-skin="" -->
                <h5 class="text-15 mb-3 capitalize underline">Skin Layouts</h5>
                <div class="mb-5 grid grid-cols-1 gap-7 sm:grid-cols-2">
                    <div class="relative">
                        <input id="layoutSkitOne" name="dataLayoutSkin"
                            class="vertical-menu-btn checked:bg-custom-500 checked:border-custom-500 dark:bg-zink-400 dark:border-zink-500 absolute top-2 h-4 w-4 cursor-pointer appearance-none rounded-full border border-slate-300 bg-slate-100 ltr:right-2 rtl:left-2"
                            type="radio" value="default">
                        <label
                            class="dark:border-zink-500 dark:bg-zink-600 block h-24 w-full cursor-pointer overflow-hidden rounded-lg border border-slate-200 bg-slate-50 p-0"
                            for="layoutSkitOne">
                            <span class="flex h-full gap-0">
                                <span class="shrink-0">
                                    <span
                                        class="dark:border-zink-500 flex h-full flex-col gap-1 border-slate-200 p-1 ltr:border-r rtl:border-l">
                                        <span class="dark:bg-zink-400 mb-2 block rounded bg-slate-100 p-1 px-2"></span>
                                        <span class="dark:bg-zink-500 block bg-slate-100 p-1 px-2 pb-0"></span>
                                        <span class="dark:bg-zink-500 block bg-slate-100 p-1 px-2 pb-0"></span>
                                        <span class="dark:bg-zink-500 block bg-slate-100 p-1 px-2 pb-0"></span>
                                    </span>
                                </span>
                                <span class="grow">
                                    <span class="flex h-full flex-col">
                                        <span class="dark:bg-zink-500 block h-3 bg-slate-100"></span>
                                        <span class="dark:bg-zink-500 mt-auto block h-3 bg-slate-100"></span>
                                    </span>
                                </span>
                            </span>
                        </label>
                        <h5 class="text-15 mt-2 text-center">Default</h5>
                    </div>

                    <div class="relative">
                        <input id="layoutSkitTwo" name="dataLayoutSkin"
                            class="vertical-menu-btn checked:bg-custom-500 checked:border-custom-500 dark:bg-zink-400 dark:border-zink-500 absolute top-2 h-4 w-4 cursor-pointer appearance-none rounded-full border border-slate-300 bg-slate-100 ltr:right-2 rtl:left-2"
                            type="radio" value="bordered" checked="">
                        <label
                            class="dark:border-zink-500 block h-24 w-full cursor-pointer overflow-hidden rounded-lg border border-slate-200 p-0"
                            for="layoutSkitTwo">
                            <span class="flex h-full gap-0">
                                <span class="shrink-0">
                                    <span
                                        class="dark:border-zink-500 flex h-full flex-col gap-1 border-slate-200 p-1 ltr:border-r rtl:border-l">
                                        <span class="dark:bg-zink-400 mb-2 block rounded bg-slate-100 p-1 px-2"></span>
                                        <span class="dark:bg-zink-500 block bg-slate-100 p-1 px-2 pb-0"></span>
                                        <span class="dark:bg-zink-500 block bg-slate-100 p-1 px-2 pb-0"></span>
                                        <span class="dark:bg-zink-500 block bg-slate-100 p-1 px-2 pb-0"></span>
                                    </span>
                                </span>
                                <span class="grow">
                                    <span class="flex h-full flex-col">
                                        <span class="dark:border-zink-500 block h-3 border-b border-slate-200"></span>
                                        <span
                                            class="dark:border-zink-500 mt-auto block h-3 border-t border-slate-200"></span>
                                    </span>
                                </span>
                            </span>
                        </label>
                        <h5 class="text-15 mt-2 text-center">Bordered</h5>
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <!-- data-mode="" -->
                <h5 class="text-15 mb-3 capitalize underline">Light & Dark</h5>
                <div class="flex gap-3">
                    <button type="button" id="dataModeOne" name="dataMode" value="light"
                        class="btn [&.active]:text-custom-500 [&.active]:bg-custom-50 [&.active]:border-custom-200 dark:bg-zink-600 dark:text-zink-200 dark:border-zink-400 dark:hover:bg-zink-600 dark:hover:text-zink-100 dark:hover:border-zink-400 dark:[&.active]:bg-custom-500/10 dark:[&.active]:border-custom-500/30 dark:[&.active]:text-custom-500 active border-dashed border-slate-200 bg-white text-slate-500 transition-all duration-200 ease-linear hover:border-slate-200 hover:bg-slate-50 hover:text-slate-500">Light
                        Mode</button>
                    <button type="button" id="dataModeTwo" name="dataMode" value="dark"
                        class="btn [&.active]:text-custom-500 [&.active]:bg-custom-50 [&.active]:border-custom-200 dark:bg-zink-600 dark:text-zink-200 dark:border-zink-400 dark:hover:bg-zink-600 dark:hover:text-zink-100 dark:hover:border-zink-400 dark:[&.active]:bg-custom-500/10 dark:[&.active]:border-custom-500/30 dark:[&.active]:text-custom-500 border-dashed border-slate-200 bg-white text-slate-500 transition-all duration-200 ease-linear hover:border-slate-200 hover:bg-slate-50 hover:text-slate-500">Dark
                        Mode</button>
                </div>
            </div>

            <div class="mt-6">
                <!-- dir="ltr" -->
                <h5 class="text-15 mb-3 capitalize underline">LTR & RTL</h5>
                <div class="flex flex-wrap gap-3">
                    <button type="button" id="diractionOne" name="dir" value="ltr"
                        class="btn [&.active]:text-custom-500 [&.active]:bg-custom-50 [&.active]:border-custom-200 dark:bg-zink-600 dark:text-zink-200 dark:border-zink-400 dark:hover:bg-zink-600 dark:hover:text-zink-100 dark:hover:border-zink-400 dark:[&.active]:bg-custom-500/10 dark:[&.active]:border-custom-500/30 dark:[&.active]:text-custom-500 active border-dashed border-slate-200 bg-white text-slate-500 transition-all duration-200 ease-linear hover:border-slate-200 hover:bg-slate-50 hover:text-slate-500">LTR
                        Mode</button>
                    <button type="button" id="diractionTwo" name="dir" value="rtl"
                        class="btn [&.active]:text-custom-500 [&.active]:bg-custom-50 [&.active]:border-custom-200 dark:bg-zink-600 dark:text-zink-200 dark:border-zink-400 dark:hover:bg-zink-600 dark:hover:text-zink-100 dark:hover:border-zink-400 dark:[&.active]:bg-custom-500/10 dark:[&.active]:border-custom-500/30 dark:[&.active]:text-custom-500 border-dashed border-slate-200 bg-white text-slate-500 transition-all duration-200 ease-linear hover:border-slate-200 hover:bg-slate-50 hover:text-slate-500">RTL
                        Mode</button>
                </div>
            </div>

            <div class="mt-6">
                <!-- data-content -->
                <h5 class="text-15 mb-3 capitalize underline">Content Width</h5>
                <div class="flex gap-3">
                    <button type="button" id="datawidthOne" name="datawidth" value="fluid"
                        class="btn [&.active]:text-custom-500 [&.active]:bg-custom-50 [&.active]:border-custom-200 dark:bg-zink-600 dark:text-zink-200 dark:border-zink-400 dark:hover:bg-zink-600 dark:hover:text-zink-100 dark:hover:border-zink-400 dark:[&.active]:bg-custom-500/10 dark:[&.active]:border-custom-500/30 dark:[&.active]:text-custom-500 active border-dashed border-slate-200 bg-white text-slate-500 transition-all duration-200 ease-linear hover:border-slate-200 hover:bg-slate-50 hover:text-slate-500">Fluid</button>
                    <button type="button" id="datawidthTwo" name="datawidth" value="boxed"
                        class="btn [&.active]:text-custom-500 [&.active]:bg-custom-50 [&.active]:border-custom-200 dark:bg-zink-600 dark:text-zink-200 dark:border-zink-400 dark:hover:bg-zink-600 dark:hover:text-zink-100 dark:hover:border-zink-400 dark:[&.active]:bg-custom-500/10 dark:[&.active]:border-custom-500/30 dark:[&.active]:text-custom-500 border-dashed border-slate-200 bg-white text-slate-500 transition-all duration-200 ease-linear hover:border-slate-200 hover:bg-slate-50 hover:text-slate-500">Boxed</button>
                </div>
            </div>

            <div class="mt-6" id="sidebar-size">
                <!-- data-sidebar-size="" -->
                <h5 class="text-15 mb-3 capitalize underline">Sidebar Size</h5>
                <div class="flex flex-wrap gap-3">
                    <button type="button" id="sidebarSizeOne" name="sidebarSize" value="lg"
                        class="btn [&.active]:text-custom-500 [&.active]:bg-custom-50 [&.active]:border-custom-200 dark:bg-zink-600 dark:text-zink-200 dark:border-zink-400 dark:hover:bg-zink-600 dark:hover:text-zink-100 dark:hover:border-zink-400 dark:[&.active]:bg-custom-500/10 dark:[&.active]:border-custom-500/30 dark:[&.active]:text-custom-500 active border-dashed border-slate-200 bg-white text-slate-500 transition-all duration-200 ease-linear hover:border-slate-200 hover:bg-slate-50 hover:text-slate-500">Default</button>
                    <button type="button" id="sidebarSizeTwo" name="sidebarSize" value="md"
                        class="btn [&.active]:text-custom-500 [&.active]:bg-custom-50 [&.active]:border-custom-200 dark:bg-zink-600 dark:text-zink-200 dark:border-zink-400 dark:hover:bg-zink-600 dark:hover:text-zink-100 dark:hover:border-zink-400 dark:[&.active]:bg-custom-500/10 dark:[&.active]:border-custom-500/30 dark:[&.active]:text-custom-500 border-dashed border-slate-200 bg-white text-slate-500 transition-all duration-200 ease-linear hover:border-slate-200 hover:bg-slate-50 hover:text-slate-500">Compact</button>
                    <button type="button" id="sidebarSizeThree" name="sidebarSize" value="sm"
                        class="btn [&.active]:text-custom-500 [&.active]:bg-custom-50 [&.active]:border-custom-200 dark:bg-zink-600 dark:text-zink-200 dark:border-zink-400 dark:hover:bg-zink-600 dark:hover:text-zink-100 dark:hover:border-zink-400 dark:[&.active]:bg-custom-500/10 dark:[&.active]:border-custom-500/30 dark:[&.active]:text-custom-500 border-dashed border-slate-200 bg-white text-slate-500 transition-all duration-200 ease-linear hover:border-slate-200 hover:bg-slate-50 hover:text-slate-500">Small
                        (Icon)</button>
                </div>
            </div>

            <div class="mt-6" id="navigation-type">
                <!-- data-navbar="" -->
                <h5 class="text-15 mb-3 capitalize underline">Navigation Type</h5>
                <div class="flex flex-wrap gap-3">
                    <button type="button" id="navbarTwo" name="navbar" value="sticky"
                        class="btn [&.active]:text-custom-500 [&.active]:bg-custom-50 [&.active]:border-custom-200 dark:bg-zink-600 dark:text-zink-200 dark:border-zink-400 dark:hover:bg-zink-600 dark:hover:text-zink-100 dark:hover:border-zink-400 dark:[&.active]:bg-custom-500/10 dark:[&.active]:border-custom-500/30 dark:[&.active]:text-custom-500 active border-dashed border-slate-200 bg-white text-slate-500 transition-all duration-200 ease-linear hover:border-slate-200 hover:bg-slate-50 hover:text-slate-500">Sticky</button>
                    <button type="button" id="navbarOne" name="navbar" value="scroll"
                        class="btn [&.active]:text-custom-500 [&.active]:bg-custom-50 [&.active]:border-custom-200 dark:bg-zink-600 dark:text-zink-200 dark:border-zink-400 dark:hover:bg-zink-600 dark:hover:text-zink-100 dark:hover:border-zink-400 dark:[&.active]:bg-custom-500/10 dark:[&.active]:border-custom-500/30 dark:[&.active]:text-custom-500 border-dashed border-slate-200 bg-white text-slate-500 transition-all duration-200 ease-linear hover:border-slate-200 hover:bg-slate-50 hover:text-slate-500">Scroll</button>
                    <button type="button" id="navbarThree" name="navbar" value="bordered"
                        class="btn [&.active]:text-custom-500 [&.active]:bg-custom-50 [&.active]:border-custom-200 dark:bg-zink-600 dark:text-zink-200 dark:border-zink-400 dark:hover:bg-zink-600 dark:hover:text-zink-100 dark:hover:border-zink-400 dark:[&.active]:bg-custom-500/10 dark:[&.active]:border-custom-500/30 dark:[&.active]:text-custom-500 border-dashed border-slate-200 bg-white text-slate-500 transition-all duration-200 ease-linear hover:border-slate-200 hover:bg-slate-50 hover:text-slate-500">Bordered</button>
                    <button type="button" id="navbarFour" name="navbar" value="hidden"
                        class="btn [&.active]:text-custom-500 [&.active]:bg-custom-50 [&.active]:border-custom-200 dark:bg-zink-600 dark:text-zink-200 dark:border-zink-400 dark:hover:bg-zink-600 dark:hover:text-zink-100 dark:hover:border-zink-400 dark:[&.active]:bg-custom-500/10 dark:[&.active]:border-custom-500/30 dark:[&.active]:text-custom-500 border-dashed border-slate-200 bg-white text-slate-500 transition-all duration-200 ease-linear hover:border-slate-200 hover:bg-slate-50 hover:text-slate-500">Hidden</button>
                </div>
            </div>

            <div class="mt-6" id="sidebar-color">
                <!-- data-sidebar="" light, dark, brand, modern-->
                <h5 class="text-15 mb-3 capitalize underline">Sizebar Colors</h5>
                <div class="flex flex-wrap gap-3">
                    <button type="button" id="sidebarColorOne" name="sidebarColor" value="light"
                        class="active group flex h-10 w-10 items-center justify-center rounded-md border border-slate-200 bg-white"><i
                            data-lucide="check"
                            class="hidden h-5 w-5 text-slate-600 group-[.active]:inline-block"></i></button>
                    <button type="button" id="sidebarColorTwo" name="sidebarColor" value="dark"
                        class="border-zink-900 bg-zink-900 group flex h-10 w-10 items-center justify-center rounded-md border"><i
                            data-lucide="check"
                            class="hidden h-5 w-5 text-white group-[.active]:inline-block"></i></button>
                    <button type="button" id="sidebarColorThree" name="sidebarColor" value="brand"
                        class="border-custom-800 bg-custom-800 group flex h-10 w-10 items-center justify-center rounded-md border"><i
                            data-lucide="check"
                            class="hidden h-5 w-5 text-white group-[.active]:inline-block"></i></button>
                    <button type="button" id="sidebarColorFour" name="sidebarColor" value="modern"
                        class="group flex h-10 w-10 items-center justify-center rounded-md border border-purple-950 bg-gradient-to-t from-red-400 to-purple-500"><i
                            data-lucide="check"
                            class="hidden h-5 w-5 text-white group-[.active]:inline-block"></i></button>
                </div>
            </div>

            <div class="mt-6">
                <!-- data-topbar="" light, dark, brand, modern-->
                <h5 class="text-15 mb-3 capitalize underline">Topbar Colors</h5>
                <div class="flex flex-wrap gap-3">
                    <button type="button" id="topbarColorOne" name="topbarColor" value="light"
                        class="active group flex h-10 w-10 items-center justify-center rounded-md border border-slate-200 bg-white"><i
                            data-lucide="check"
                            class="hidden h-5 w-5 text-slate-600 group-[.active]:inline-block"></i></button>
                    <button type="button" id="topbarColorTwo" name="topbarColor" value="dark"
                        class="border-zink-900 bg-zink-900 group flex h-10 w-10 items-center justify-center rounded-md border"><i
                            data-lucide="check"
                            class="hidden h-5 w-5 text-white group-[.active]:inline-block"></i></button>
                    <button type="button" id="topbarColorThree" name="topbarColor" value="brand"
                        class="border-custom-800 bg-custom-800 group flex h-10 w-10 items-center justify-center rounded-md border"><i
                            data-lucide="check"
                            class="hidden h-5 w-5 text-white group-[.active]:inline-block"></i></button>
                </div>
            </div>

        </div>
    </div>

    @include('admin.layouts.script')
</body>

</html>
