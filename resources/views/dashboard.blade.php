@extends('layout.layout')
@php
$title='Dasbor Utama';
$subTitle = 'Dasbor Utama';
$script = '';

@endphp

@section('content')

<div class="row gy-4">
    <div class="col-12">

        <div class="row gy-4">
            <div class="col-xl-6 col-sm-6">
                <div
                    class="card shadow-none border bg-gradient-start-1 px-20 py-16 radius-8 h-100 gradient-deep-1 left-line line-bg-primary position-relative overflow-hidden">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                        <div>
                            <span class="mb-2 fw-medium text-secondary-light text-md">Sisa Saldo</span>
                            <h6 class="fw-semibold mb-1">Rp. {{ format_uang($sisa_saldo) }}</h6>
                        </div>
                        <span
                            class="w-44-px h-44-px radius-8 d-inline-flex justify-content-center align-items-center text-2xl mb-12 bg-primary-100 text-primary-600">
                            <i class="ri-handbag-fill"></i>
                        </span>
                    </div>
                    <!-- <p class="text-sm mb-0"><span class="bg-success-focus px-1 rounded-2 fw-medium text-success-main text-sm"><i class="ri-arrow-right-up-line"></i> 80%</span> From last month </p> -->
                </div>
            </div>
            <div class="col-xl-6 col-sm-6">
                <div
                    class="card shadow-none border bg-gradient-start-2 px-20 py-16 radius-8 h-100 gradient-deep-2 left-line line-bg-warning position-relative overflow-hidden">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                        <div>
                            <span class="mb-2 fw-medium text-secondary-light text-md">Pengeluaran Terkini</span>
                            <h6 class="fw-semibold mb-1">Rp. {{ format_uang($pengeluaran_sejak_topup) }}</h6>
                        </div>
                        <span
                            class="w-44-px h-44-px radius-8 d-inline-flex justify-content-center align-items-center text-2xl mb-12 bg-warning-200 text-warning-600">
                            <i class="ri-shopping-cart-fill"></i>
                        </span>
                    </div>
                    <!-- <p class="text-sm mb-0"><span class="bg-success-focus px-1 rounded-2 fw-medium text-success-main text-sm"><i class="ri-arrow-right-up-line"></i> 95%</span> From last month </p> -->
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-8">
        <div class="card h-100">
            <div class="card-body p-24 mb-8">
                <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                    <h6 class="mb-2 fw-bold text-lg mb-0">Pengeluaran Bulan {{$bulanSekarang}}</h6>
                </div>
                <ul class="d-flex flex-wrap align-items-center justify-content-center my-3 gap-24">
                    <li class="d-flex flex-column gap-1">
                        <div class="d-flex align-items-center gap-2">
                            <span class="w-8-px h-8-px rounded-pill bg-warning-500"></span>
                            <span class="text-secondary-light text-sm fw-semibold">Pengeluaran </span>
                        </div>
                        <div class="d-flex align-items-center gap-8">
                            <h6 class="mb-0">Rp. {{ format_uang($totalPembelian) }}</h6>

                        </div>
                    </li>

                </ul>
                <div id="incomeExpense" class="apexcharts-tooltip-style-1"></div>
            </div>
        </div>
    </div>
    <div class="col-xxl-4 col-md-6">
        <div class="card h-100">
            <div class="card-header">
                <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                    <h6 class="mb-2 fw-bold text-lg">Laporan Keseluruhan</h6>
                </div>
            </div>
            <div class="card-body p-24">
                <div class="mt-32">
                    <div id="userOverviewDonutChart" class="mx-auto apexcharts-tooltip-z-none"></div>
                </div>
                <div class="d-flex flex-wrap gap-20 justify-content-center mt-48">
                    <div class="d-flex align-items-center gap-8">
                        <span class="w-16-px h-16-px radius-2 bg-success-600"></span>
                        <span class="text-secondary-light">Top Up</span>
                    </div>
                    <div class="d-flex align-items-center gap-8">
                        <span class="w-16-px h-16-px radius-2 bg-warning-600"></span>
                        <span class="text-secondary-light">Pengeluaran</span>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-12">
        <div class="card h-100">
            <div class="card-header">
                <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                    <h6 class="mb-2 fw-bold text-lg mb-0">Riwayat Pembelian Terbaru</h6>
                    <a href="{{route('laporan.pembelian')}}"
                        class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                        Lihat Semua
                        <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                    </a>
                </div>
            </div>
            <div class="card-body p-24">
                <div class="table-responsive scroll-sm">
                    <table class="table bordered-table mb-0">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">No.</th>
                                <th scope="col" class="text-center">Tanggal</th>
                                <th scope="col" class="text-center">Barang</th>
                                <th scope="col" class="text-center">Harga (Rp)</th>
                                <th scope="col" class="text-center">Qty</th>
                                <th scope="col" class="text-center">Subtotal (Rp)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sales as $i => $sale)
                            <tr>
                                <td class="text-center">{{$i + 1}}</td>
                                <td class="text-center">{{tanggal_indonesia($sale->DateEncoded)}}</td>
                                <td class="text-center">{{$sale->Description}}</td>
                                <td class="text-center">{{format_uang($sale->UnitPrice)}}</td>
                                <td class="text-center">{{$sale->Quantity}}</td>
                                <td class="text-center">{{format_uang($sale->Subtotal)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-12">
        <div class="card h-100">
            <div class="card-header">
                <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                    <h6 class="mb-2 fw-bold text-lg mb-0">Riwayat Top Up Terbaru</h6>
                    <a href="{{route('laporan.topup')}}"
                        class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                        Lihat Semua
                        <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                    </a>
                </div>
            </div>
            <div class="card-body p-24">
                <div class="table-responsive scroll-sm">
                    <table class="table bordered-table mb-0">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">No.</th>
                                <th scope="col" class="text-center">Tanggal</th>
                                <th scope="col" class="text-center">Nominal (Rp)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($deposit as $i => $depo)
                            <tr>
                                <td class="text-center">{{$i + 1}}</td>
                                <td class="text-center">{{tanggal_indonesia($depo->Dateencoded)}}</td>
                                <td class="text-center">{{format_uang($depo->Top_Up)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    // ===================== Income VS Expense Start =============================== 
    function createChartTwo(chartId, color1) {
        var labels = @json($data_tanggal);
        var pengeluaran = @json($data_pengeluaran);
        var options = {
            series: [{
                name: "Pengeluaran",
                data: pengeluaran
            }],
            legend: {
                show: false
            },
            chart: {
                type: "area",
                width: "100%",
                height: 270,
                toolbar: {
                    show: false
                },
                padding: {
                    left: 0,
                    right: 0,
                    top: 0,
                    bottom: 0
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: "smooth",
                width: 3,
                colors: [color1], // Use two colors for the lines
                lineCap: "round"
            },
            grid: {
                show: true,
                borderColor: "#EAB308",
                strokeDashArray: 1,
                position: "back",
                xaxis: {
                    lines: {
                        show: false
                    }
                },
                yaxis: {
                    lines: {
                        show: true
                    }
                },
                row: {
                    colors: undefined,
                    opacity: 0.5
                },
                column: {
                    colors: undefined,
                    opacity: 0.5
                },
                padding: {
                    top: -20,
                    right: 0,
                    bottom: -10,
                    left: 0
                },
            },
            fill: {
                type: "gradient",
                colors: [color1], // Use two colors for the gradient
                gradient: {
                    shade: "light",
                    type: "vertical",
                    shadeIntensity: 0.5,
                    gradientToColors: [undefined, `${color1}00`], // Apply transparency to both colors
                    inverseColors: false,
                    opacityFrom: [0.4, 0.6], // Starting opacity for both colors
                    opacityTo: [0.3, 0.3], // Ending opacity for both colors
                    stops: [0, 100],
                },
            },
            markers: {
                colors: [color1], // Use two colors for the markers
                strokeWidth: 3,
                size: 0,
                hover: {
                    size: 10
                }
            },
            xaxis: {
                labels: {
                    show: false
                },
                categories: labels,
                tooltip: {
                    enabled: false
                },
                labels: {
                    formatter: function (value) {
                        return value;
                    },
                    style: {
                        fontSize: "14px"
                    }
                }
            },
            yaxis: {
                labels: {
                    formatter: function (value) {
                        return "Rp." + value;
                    },
                    style: {
                        fontSize: "14px"
                    }
                },
            },
            tooltip: {
                x: {
                    format: "dd/MM/yy HH:mm"
                }
            }
        };

        var chart = new ApexCharts(document.querySelector(`#${chartId}`), options);
        chart.render();
    }

    createChartTwo("incomeExpense", "#EAB308");
    // ===================== Income VS Expense End =============================== 

    // ================================ Users Overview Donut chart Start ================================ 
    var options = {
        series: @json($data_piechart),
        colors: ["#16A34A", "#FF9F29"],
        labels: ["Top Up", "Pengeluaran"],
        legend: {
            show: false
        },
        chart: {
            type: "donut",
            height: 270,
            sparkline: {
                enabled: true // Remove whitespace
            },
            margin: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
            },
            padding: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
            }
        },
        stroke: {
            width: 0,
        },
        dataLabels: {
            enabled: true
        },

        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: "bottom"
                }
            }
        }],

    };

    var chart = new ApexCharts(document.querySelector("#userOverviewDonutChart"), options);
    chart.render();
    // ================================ Users Overview Donut chart End ================================ 

</script>
@endpush
