@extends('layout.layout')
@php
$title='Riwayat Pembelian';
$subTitle = 'Riwayat Pembelian';
$script = '';
@endphp

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="card h-100 p-0 radius-12">

    <div class="card-body">
        <!-- 
        <form action="" method="post" class="needs-validation" novalidate>
            @csrf
            @method('post') 
                <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label class="col-form-label">Date</label>
            </div>
            <div class="col-auto">
                <input type="date" id="date-start" class="form-control" required>
            </div>
            <div class="col-auto">
                <label class="col-form-label">-</label>
            </div>
            <div class="col-auto">
                <input type="date" id="date-end" class="form-control" required>
            </div>
            <div class="col-auto">
                <button type="submit"
                    class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2"
                    data-bs-toggle="modal" data-bs-target="#addModal">
                    <iconify-icon icon="mdi:filter-outline" class="icon text-xl line-height-1"></iconify-icon>Filter
                </button>
            </div>
        </div> 
</form>-->
        <div class="table-responsive scroll-sm">
            <table class="table bordered-table sm-table mb-0" id="dataTable" cellspacing="0">
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
                <tbody id="table">
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



@endsection

@push('scripts')
<script>
    let datatable;
    $(document).ready(function () {
        datatable = $('#dataTable').DataTable({
        paging: true, // Aktifkan pagination
        autoWidth: true, // Sesuaikan lebar kolom secara otomatis
        fixedHeader: false, // Nonaktifkan fixed header

            buttons: ['excelHtml5', 'csvHtml5', 'pdfHtml5', 'print', ],
            initComplete: function () {
                var btns = $('.dt-button');
                btns.addClass('btn btn-success btn-sm');
                btns.removeClass('dt-button');

            },
            layout: {
                topStart: 'search',
                topEnd: ['buttons']
            }

        });
    });

</script>
@endpush
