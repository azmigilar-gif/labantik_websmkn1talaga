@extends('admin.layouts.app')
@section('title', 'Dashboard Admin')
@section('content')
    <div
        class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm px-4 pb-[calc(theme('spacing.header')_*_0.8)] pt-[calc(theme('spacing.header')_*_1)] group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)] group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16">Dashboard</h5>
                </div>
                <ul class="flex shrink-0 items-center gap-2 text-sm font-normal">
                    <li
                        class="before:font-remix dark:text-zink-200 relative before:absolute before:-top-[3px] before:text-[18px] before:text-slate-400 ltr:pr-4 ltr:before:-right-1 rtl:pl-4 rtl:before:-left-1">
                        <a href="#!" class="dark:text-zink-200 text-slate-400">Dashboards</a>
                    </li>
                </ul>
            </div>
            <div class="grid grid-cols-12 gap-x-5">
                <!-- Card 1: Siswa Aktif -->
                <div class="card col-span-12 md:col-span-6 lg:col-span-3">
                    <div class="card-body flex items-center gap-4">
                        <div class="flex size-12 items-center justify-center rounded-lg bg-sky-100 text-sky-500 dark:bg-sky-500/20">
                            <i data-lucide="users" class="size-6"></i>
                        </div>
                        <div>
                            <h5 class="mb-1 text-slate-800 dark:text-zink-50"><span class="counter-value" data-target="{{ $countStudents }}">0</span></h5>
                            <p class="text-sm text-slate-500 dark:text-zink-200">Siswa Aktif</p>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Guru & Staf -->
                <div class="card col-span-12 md:col-span-6 lg:col-span-3">
                    <div class="card-body flex items-center gap-4">
                        <div class="flex size-12 items-center justify-center rounded-lg bg-purple-100 text-purple-500 dark:bg-purple-500/20">
                            <i data-lucide="users" class="size-6"></i>
                        </div>
                        <div>
                            <h5 class="mb-1 text-slate-800 dark:text-zink-50"><span class="counter-value" data-target="{{ $countEmployees }}">0</span></h5>
                            <p class="text-sm text-slate-500 dark:text-zink-200">Guru & Staf</p>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Jurusan Keahlian -->
                <div class="card col-span-12 md:col-span-6 lg:col-span-3">
                    <div class="card-body flex items-center gap-4">
                        <div class="flex size-12 items-center justify-center rounded-lg bg-pink-100 text-pink-500 dark:bg-pink-500/20">
                            <i data-lucide="award" class="size-6"></i>
                        </div>
                        <div>
                            <h5 class="mb-1 text-slate-800 dark:text-zink-50"><span class="counter-value" data-target="{{ $countConcentrations }}">0</span></h5>
                            <p class="text-sm text-slate-500 dark:text-zink-200">Jurusan Keahlian</p>
                        </div>
                    </div>
                </div>

                <!-- Card 4: Mitra Kerja -->
                <div class="card col-span-12 md:col-span-6 lg:col-span-3">
                    <div class="card-body flex items-center gap-4">
                        <div class="flex size-12 items-center justify-center rounded-lg bg-blue-100 text-blue-500 dark:bg-blue-500/20">
                            <i data-lucide="briefcase" class="size-6"></i>
                        </div>
                        <div>
                            <h5 class="mb-1 text-slate-800 dark:text-zink-50"><span class="counter-value" data-target="{{ $countMitra }}">0</span></h5>
                            <p class="text-sm text-slate-500 dark:text-zink-200">Mitra Kerjasama</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-12 gap-x-5 mt-5">
                <!-- Chart Section -->
                <div class="card col-span-12 lg:col-span-8">
                    <div class="card-body">
                        <div class="mb-3 flex items-center">
                            <h6 class="text-15 grow">Statistik Status Berita</h6>
                        </div>
                        <div id="newsStatisticsChart" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>

                <!-- Ringkasan Sistem -->
                <div class="card col-span-12 lg:col-span-4">
                    <div class="card-body">
                        <h6 class="text-15 mb-4">Ringkasan Konten Web</h6>
                        <div class="flex flex-col gap-4">
                            <!-- Total Berita -->
                            <div class="flex items-center justify-between p-3 rounded-lg bg-sky-50 dark:bg-sky-500/10">
                                <div class="flex items-center gap-3">
                                    <div class="flex size-10 items-center justify-center rounded-full bg-sky-100 text-sky-600 dark:bg-sky-500/20">
                                        <i data-lucide="newspaper" class="size-5"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-sm font-semibold text-slate-700 dark:text-zink-100">Total Berita</h6>
                                        <p class="text-xs text-slate-500">{{ $countNewsApprove }} Tayang • {{ $countNewsPending }} Pending</p>
                                    </div>
                                </div>
                                <span class="text-lg font-bold text-sky-600"><span class="counter-value" data-target="{{ $countNews }}">0</span></span>
                            </div>

                            <!-- Galeri Media -->
                            <div class="flex items-center justify-between p-3 rounded-lg bg-pink-50 dark:bg-pink-500/10">
                                <div class="flex items-center gap-3">
                                    <div class="flex size-10 items-center justify-center rounded-full bg-pink-100 text-pink-600 dark:bg-pink-500/20">
                                        <i data-lucide="image" class="size-5"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-sm font-semibold text-slate-700 dark:text-zink-100">Galeri Media</h6>
                                        <p class="text-xs text-slate-500">Dokumentasi foto & video</p>
                                    </div>
                                </div>
                                <span class="text-lg font-bold text-pink-600"><span class="counter-value" data-target="{{ $countGallery }}">0</span></span>
                            </div>

                            <!-- Ekstrakurikuler -->
                            <div class="flex items-center justify-between p-3 rounded-lg bg-purple-50 dark:bg-purple-500/10">
                                <div class="flex items-center gap-3">
                                    <div class="flex size-10 items-center justify-center rounded-full bg-purple-100 text-purple-600 dark:bg-purple-500/20">
                                        <i data-lucide="trophy" class="size-5"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-sm font-semibold text-slate-700 dark:text-zink-100">Ekstrakurikuler</h6>
                                        <p class="text-xs text-slate-500">Minat bakat siswa</p>
                                    </div>
                                </div>
                                <span class="text-lg font-bold text-purple-600"><span class="counter-value" data-target="{{ $countExtrakurikuler }}">0</span></span>
                            </div>

                            <!-- Menu Navigasi -->
                            <div class="flex items-center justify-between p-3 rounded-lg bg-slate-50 dark:bg-slate-500/10">
                                <div class="flex items-center gap-3">
                                    <div class="flex size-10 items-center justify-center rounded-full bg-slate-100 text-slate-600 dark:bg-slate-500/20">
                                        <i data-lucide="menu" class="size-5"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-sm font-semibold text-slate-700 dark:text-zink-100">Menu Navigasi</h6>
                                        <p class="text-xs text-slate-500">Struktur navigasi web</p>
                                    </div>
                                </div>
                                <span class="text-lg font-bold text-slate-600"><span class="counter-value" data-target="{{ $countMenu }}">0</span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Data dari Laravel
            var chartData = {
                weeks: @json($weeksData['weeks'] ?? []),
                published: @json($weeksData['published'] ?? []),
                pending: @json($weeksData['pending'] ?? []),
            };

            // Konfigurasi chart
            var options = {
                series: [{
                    name: 'Berita Pending',
                    data: chartData.pending
                }, {
                    name: 'Berita Terupload',
                    data: chartData.published
                }],

                chart: {
                    type: 'area',
                    height: 350,
                    toolbar: {
                        show: true
                    },
                    zoom: {
                        enabled: true
                    }
                },

                dataLabels: {
                    enabled: false
                },

                stroke: {
                    curve: 'smooth',
                    width: 3
                },

                markers: {
                    size: 0
                },

                colors: ['#a855f7', '#0ea5e9'],

                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.4,
                        opacityTo: 0.1,
                        stops: [0, 90, 100]
                    }
                },

                xaxis: {
                    categories: chartData.weeks,
                    labels: {
                        style: {
                            colors: '#9ca3af',
                            fontSize: '12px'
                        },
                        rotate: -45,
                        rotateAlways: false,
                        hideOverlappingLabels: true,
                        trim: false
                    },
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    }
                },

                yaxis: {
                    labels: {
                        style: {
                            colors: '#9ca3af',
                            fontSize: '12px'
                        }
                    }
                },

                grid: {
                    borderColor: '#f3f4f6',
                    strokeDashArray: 4,
                    xaxis: {
                        lines: {
                            show: false
                        }
                    }
                },

                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + " berita"
                        }
                    }
                },

                legend: {
                    position: 'bottom',
                    horizontalAlign: 'center',
                    markers: {
                        width: 10,
                        height: 10,
                        radius: 10,
                    },
                    itemMargin: {
                        horizontal: 15
                    }
                }
            };

            // Render chart
            var chart = new ApexCharts(document.querySelector("#newsStatisticsChart"), options);
            chart.render();
        });
    </script>
@endpush
