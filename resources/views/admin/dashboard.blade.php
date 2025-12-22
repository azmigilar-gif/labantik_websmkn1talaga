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
            <div class="grid grid-cols-12 gap-x-5 2xl:grid-cols-12">
                <div class="card col-span-12 2xl:col-span-4 2xl:row-span-2">
                    <div class="card-body">
                        <div class="mb-3 flex items-center">
                            <h6 class="text-15 grow">Statistik Status Berita</h6>
                        </div>
                        <div id="newsStatisticsChart" class="apex-charts" dir="ltr"></div>
                    </div>
                </div><!--end col-->
                <div class="card col-span-12 md:col-span-6 lg:col-span-3 2xl:col-span-2">
                    <div class="card-body text-center">
                        <div
                            class="bg-custom-100 text-custom-500 dark:bg-custom-500/20 mx-auto flex size-14 items-center justify-center rounded-full">
                            <i data-lucide="newspaper"></i>
                        </div>
                        <h5 class="mb-2 mt-4"><span class="counter-value" data-target="{{ $countNews }}">0</span></h5>
                        <p class="dark:text-zink-200 text-slate-500">Total Berita</p>
                    </div>
                </div><!--end col-->
                <div class="card col-span-12 md:col-span-6 lg:col-span-3 2xl:col-span-2">
                    <div class="card-body text-center">
                        <div
                            class="mx-auto flex size-14 items-center justify-center rounded-full bg-purple-100 text-purple-500 dark:bg-purple-500/20">
                            <i data-lucide="list-checks"></i>
                        </div>
                        <h5 class="mb-2 mt-4"><span class="counter-value" data-target="{{ $countNewsApprove }}">0</span>
                        </h5>
                        <p class="dark:text-zink-200 text-slate-500">Total Berita Terupload</p>
                    </div>
                </div><!--end col-->
                <div class="card col-span-12 md:col-span-6 lg:col-span-3 2xl:col-span-2">
                    <div class="card-body text-center">
                        <div
                            class="mx-auto flex size-14 items-center justify-center rounded-full bg-green-100 text-green-500 dark:bg-green-500/20">
                            <i data-lucide="circle-dashed"></i>
                        </div>
                        <h5 class="mb-2 mt-4"><span class="counter-value" data-target="{{ $countNewsPending }}">0</span>
                        </h5>
                        <p class="dark:text-zink-200 text-slate-500">Total Berita Pending</p>
                    </div>
                </div><!--end col-->
                {{-- <div class="card col-span-12 md:col-span-6 lg:col-span-3 2xl:col-span-2">
                    <div class="card-body text-center">
                        <div
                            class="mx-auto flex size-14 items-center justify-center rounded-full bg-red-100 text-red-500 dark:bg-red-500/20">
                            <i data-lucide="package-x"></i>
                        </div>
                        <h5 class="mb-2 mt-4"><span class="counter-value" data-target="3519">0</span></h5>
                        <p class="dark:text-zink-200 text-slate-500">Cancelled</p>
                    </div>
                </div><!--end col--> --}}
            </div><!--end grid-->
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
