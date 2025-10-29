@extends('layout.layout')
@php
$title='Riwayat Top Up';
$subTitle = 'Riwayat Top Up';
$script = '';
@endphp

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="card h-100 p-0 radius-12">

    <div class="card-body">
        <div class="table-responsive scroll-sm">
            <table class="table bordered-table sm-table mb-0" id="dataTable" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">No.</th>
                        <th scope="col" class="text-center">Tanggal</th>
                        <th scope="col" class="text-center">Nominal (Rp)</th>
                    </tr>
                </thead>
                <tbody id="table">
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
