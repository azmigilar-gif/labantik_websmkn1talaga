@extends('layouts.app')

@section('title', 'Laporan Tag Berita')

@section('content')
    <div class="container mx-auto px-4 py-32">
        <div class="mx-auto max-w-5xl">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-15 mb-4">Distribusi Berita Berdasarkan Tag</h6>

                    <!-- Debug Info -->
                    <div id="debugInfo" class="mb-4 p-3 bg-gray-100 rounded text-sm" style="display:none;">
                        <strong>Debug:</strong> <span id="debugText"></span>
                    </div>

                    <div id="tagNewsChart" class="apex-charts" style="min-height: 400px;"
                        data-chart-colors='["bg-slate-500", "bg-orange-500", "bg-sky-500", "bg-yellow-500", "bg-purple-500", "bg-pink-500", "bg-indigo-500", "bg-red-500", "bg-green-500", "bg-cyan-500", "bg-amber-500", "bg-lime-500", "bg-emerald-500", "bg-violet-500", "bg-fuchsia-500", "bg-rose-500", "bg-teal-500", "bg-blue-500", "bg-gray-500", "bg-stone-500", "bg-zinc-500", "bg-neutral-500", "bg-orange-600", "bg-purple-600", "bg-pink-600"]'
                        dir="ltr">
                        <div class="text-center py-8 text-gray-500">Loading...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        // Helper function untuk RGB ke HEX
        function rgbToHex(rgb) {
            const rgbValues = rgb.match(/\d+/g);
            if (rgbValues && rgbValues.length === 3) {
                const [r, g, b] = rgbValues.map(Number);
                const rHex = Math.max(0, Math.min(255, r)).toString(16).padStart(2, "0");
                const gHex = Math.max(0, Math.min(255, g)).toString(16).padStart(2, "0");
                const bHex = Math.max(0, Math.min(255, b)).toString(16).padStart(2, "0");
                return `#${rHex}${gHex}${bHex}`.toUpperCase();
            }
            return rgb;
        }

        // Function untuk mendapatkan warna dari chart element
        function getChartColorsArray(chartId) {
            const chartElement = document.getElementById(chartId);
            if (chartElement) {
                const colors = chartElement.dataset.chartColors;
                if (colors) {
                    const parsedColors = JSON.parse(colors);
                    const mappedColors = parsedColors.map((value) => {
                        const newValue = value.replace(/\s/g, "");
                        if (!newValue.includes("#")) {
                            const divElement = document.createElement("div");
                            divElement.className = newValue;
                            document.body.appendChild(divElement);

                            const styles = window.getComputedStyle(divElement);
                            const backgroundColor = styles.backgroundColor.includes("#") ?
                                styles.backgroundColor :
                                rgbToHex(styles.backgroundColor);

                            document.body.removeChild(divElement);
                            return backgroundColor || newValue;
                        } else {
                            return newValue;
                        }
                    });
                    return mappedColors;
                }
            }
            return [];
        }

        function showDebug(message) {
            const debugInfo = document.getElementById('debugInfo');
            const debugText = document.getElementById('debugText');
            debugInfo.style.display = 'block';
            debugText.textContent = message;
            console.log('DEBUG:', message);
        }

        // Load data dan render chart
        document.addEventListener('DOMContentLoaded', function() {
            const url = '{{ route('report.tag-counts') }}';
            showDebug('Fetching data from: ' + url);

            fetch(url)
                .then(response => {
                    showDebug('Response status: ' + response.status);
                    if (!response.ok) {
                        throw new Error('HTTP error! status: ' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    showDebug('Data received: ' + JSON.stringify(data).substring(0, 200) + '...');

                    if (!data || data.length === 0) {
                        document.getElementById('tagNewsChart').innerHTML =
                            '<div class="text-center py-8 text-gray-500">Tidak ada data untuk ditampilkan</div>';
                        return;
                    }

                    // CEK FORMAT DATA: apakah format baru (dengan date) atau format lama (flat array)?
                    const isNewFormat = data[0] && data[0].date !== undefined;

                    let series, dates;

                    if (isNewFormat) {
                        // FORMAT BARU: [{ date: "2024-01-15", tags: [{product: "...", nomor: 1}] }]
                        const allTags = new Set();
                        data.forEach(dayData => {
                            if (dayData.tags) {
                                dayData.tags.forEach(tag => allTags.add(tag.product));
                            }
                        });
                        const uniqueTags = Array.from(allTags);
                        showDebug('Format: NEW - Unique tags: ' + uniqueTags.length);

                        dates = data.map(item => {
                            const d = new Date(item.date);
                            return d.toLocaleDateString('id-ID', {
                                day: '2-digit',
                                month: 'short'
                            });
                        });

                        series = uniqueTags.map(tagName => {
                            const seriesData = data.map(dayData => {
                                const tagData = dayData.tags.find(t => t.product === tagName);
                                return tagData ? tagData.nomor : 0;
                            });
                            return {
                                name: tagName,
                                data: seriesData
                            };
                        });
                    } else {
                        // FORMAT LAMA: [{ product: "amy", nomor: 1 }]
                        showDebug('Format: OLD - Converting to single column');

                        series = data.map(item => ({
                            name: item.product,
                            data: [item.nomor]
                        }));

                        dates = ["Total Berita"];
                    }

                    // Get colors dari data attribute
                    const colors = getChartColorsArray("tagNewsChart");
                    showDebug('Rendering chart with ' + series.length + ' series');

                    const options = {
                        series: series,
                        chart: {
                            type: "bar",
                            height: 400,
                            stacked: true,
                            toolbar: {
                                show: true,
                            },
                            zoom: {
                                enabled: false,
                            },
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: isNewFormat ? "15%" : "50%",
                                borderRadius: 8,
                                dataLabels: {
                                    total: {
                                        enabled: true,
                                        style: {
                                            fontSize: "13px",
                                            fontWeight: 900,
                                        },
                                    },
                                },
                            },
                        },
                        colors: colors.slice(0, series.length),
                        dataLabels: {
                            enabled: false,
                        },
                        stroke: {
                            show: true,
                            width: 2,
                            colors: ["transparent"],
                        },
                        xaxis: {
                            categories: dates,
                            labels: {
                                style: {
                                    fontSize: "12px",
                                },
                            },
                        },
                        yaxis: {
                            title: {
                                text: "Jumlah Berita",
                            },
                            labels: {
                                formatter: function(val) {
                                    return Math.floor(val);
                                },
                            },
                        },
                        fill: {
                            opacity: 1,
                        },
                        legend: {
                            position: "bottom",
                            horizontalAlign: "center",
                            fontSize: "12px",
                            markers: {
                                width: 12,
                                height: 12,
                                radius: 3,
                            },
                            itemMargin: {
                                horizontal: 10,
                                vertical: 5,
                            },
                        },
                        tooltip: {
                            y: {
                                formatter: function(val) {
                                    return val + " berita";
                                },
                            },
                        },
                    };

                    const chart = new ApexCharts(
                        document.querySelector("#tagNewsChart"),
                        options
                    );
                    chart.render();

                    // Hide debug info after successful render
                    setTimeout(() => {
                        document.getElementById('debugInfo').style.display = 'none';
                    }, 3000);
                })
                .catch(error => {
                    showDebug('Error: ' + error.message);
                    console.error('Full error:', error);
                    document.getElementById('tagNewsChart').innerHTML =
                        '<div class="text-center py-8 text-red-500">Gagal memuat data chart: ' + error.message +
                        '</div>';
                });
        });
    </script>
@endpush
