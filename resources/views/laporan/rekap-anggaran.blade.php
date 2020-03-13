@section('css')
<link href="{{asset('tema/plugins/bower_components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<!-- Plugin JavaScript -->
<script src="{{asset('tema/plugins/bower_components/moment/moment.js')}}"></script>
@stop
@section('js')
<script src="{{asset('tema/plugins/bower_components/datatables/jquery.dataTables.min.js')}}"></script>
 <!-- start - This is for export functionality only -->
 <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
 <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
 <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
 <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
 <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
 <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
 <!-- end - This is for export functionality only -->
<script>
$(function () {
    $("#DataTableCustom").dataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'pdf', 'print'
        ],
        "pageLength": 30,
    });
});
</script>
@stop
@extends('layouts.default')

@section('content')
<div class="container-fluid">
                <div class="row bg-title">
                    <!-- .page title -->
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Laporan - Rekap Anggaran</h4>
                    </div>
                    <!-- /.page title -->
                    <!-- .breadcrumb -->
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

                        <ol class="breadcrumb">
                            <li><a href="{{url('')}}">Dashboard</a></li>
                            <li class="active">Laporan Rekap Anggaran</li>
                        </ol>
                    </div>
                    <!-- /.breadcrumb -->
                </div>
                <!-- .row -->
                <div class="row">
                        <div class="col-lg-12">
                                @if (Session::has('message'))
                                <div class="alert alert-{{ Session::get('message_type') }}" id="waktu2" style="margin-top:10px;">{{ Session::get('message') }}</div>
                                @endif
                                </div>
                    <div class="col-lg-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Rekap Anggaran Perjalanan Dinas yang telah dilaksanakan</h3>
                            <p class="text-muted m-b-20">@if (Session::has('tahun_anggaran')) <code>Tahun Anggaran {{Session::get('tahun_anggaran')}}</code> @endif</p>
                            <div class="table-responsive">
                                <table id="DataTableCustom" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>MAK</th>
                                            <th>Bidang/Bagian</th>
                                            <th class="text-right">Pagu Awal</th>
                                            <th class="text-right">Realisasi</th>
                                            <th class="text-right">Sisa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                         $totalpagu=0;
                                         $totalbiaya=0;
                                        @endphp
                                    @foreach ($dataAnggaran as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>
                                                @if ($item->realisasi_pagu>0) 
                                                <a href="{{route('laporan.anggaran',$item->id)}}">{{$item->mak}}</a>
                                                @else
                                                {{$item->mak}}
                                                @endif
                                                <br />
                                                <small>{{$item->uraian}}</small></td>
                                            <td>[{{$item->unitkerja}}] {{$item->Unitkerja->nama}}</td>
                                            <td class="text-right">@duit($item->pagu_utama)</td>
                                            <td class="text-right">@duit($item->realisasi_pagu)</td>
                                            <td class="text-right">@duit($item->pagu_utama-$item->realisasi_pagu)</td>
                                        </tr>
                                       @php
                                            $totalpagu += $item->pagu_utama;
                                            $totalbiaya += $item->realisasi_pagu;
                                       @endphp
                                    @endforeach
                                        @php
                                            $sisa = $totalpagu - $totalbiaya;
                                        @endphp
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="text-center">Total</th>
                                            <th class="text-right">@duit($totalpagu)</th>
                                            <th class="text-right">@duit($totalbiaya)</th>
                                            <th>@duit($sisa)</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
@endsection
