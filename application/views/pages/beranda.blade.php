@extends('layouts.panel')

@section('hstyles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('cpanel/vendor/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Beranda</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item active">Beranda</li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<!-- Info boxes -->
	<div class="row">
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-info elevation-1"><i class="fa fa-calendar-o"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Tanggal Sekarang</span>
						@php
						$datetime = new DateTime();
						$date = $datetime->format('Y-m-d');	
						@endphp
						<span class="info-box-number">{{ time_beautifier_now() }}</span>
					</div>
					<!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
			</div>
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box">
					<span class="info-box-icon bg-success elevation-1"><i class="fa fa-book"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Total Pemesanan</span>
						<span class="info-box-number">
							@if(@$info_total_pemesanan)
							{{ $info_total_pemesanan }} Pemesanan
							@else
							0 Pemesanan
							@endif
						</span>
					</div>
					<!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
			</div>
			<!-- /.col -->
			<!-- fix for small devices only -->
			<div class="clearfix hidden-md-up"></div>
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-warning elevation-1"><i class="fa fa-list-alt" style="color: #fff !important"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Total Jadwal</span>
						<span class="info-box-number">
							@if(@$info_total_jadwal)
							{{ $info_total_jadwal }} Jadwal
							@else
							0 Jadwal
							@endif
						</span>
					</div>
					<!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
			</div>
			<!-- /.col -->
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box mb-3">
					<span class="info-box-icon bg-danger elevation-1"><i class="fa fa-bus"></i>&nbsp;<i class="fa fa-bus"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Total Bis</span>
						<span class="info-box-number">
							@if(@$info_total_bis)
							{{ $info_total_bis }} Bis
							@else
							0 Bis
							@endif
						</span>
					</div>
					<!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
			</div>
			<!-- /.col -->
		</div>
		<!-- Default box -->
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Informasi Pemesanan Jadwal Keberangkatan Bus</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip"
						title="Collapse">
						<i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
						<i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<table id="table-data" class="table table-bordered table-striped text-center table-responsive-sm">
						<thead>
							<tr>
								<th rowspan="2">#</th>
								<th rowspan="2">Waktu Jam Berangkat</th>
								<th colspan="2">Rute</th>
								<th rowspan="2">Plat Nomor (Bis)</th>
								<th rowspan="2">Aksi</th>
							</tr>
							<tr>
								<th>Asal</th>
								<th>Tujuan</th>
							</tr>
						</thead>
						<tbody>
							@if(@$info_keberangkatan)
							@php
							$i = 0;
							@endphp
							@foreach ($info_keberangkatan as $info_data)
							<tr>
								<td>{{ ++$i }}</td>
								<td>{{ $info_data->Waktu }}</td>
								<td>{{ $info_data->Asal }}</td>
								<td>{{ $info_data->Tujuan }}</td>
								<td>{{ $info_data->PlatNomor }}</td>
								<td>
									<a href="{{ site_url('beranda/info/show/'.$info_data->IdJadwal) }}" class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Tampil</a>
									<a href="{{ site_url('beranda/info/confirm/'.$info_data->IdJadwal) }}" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Konfirmasi</a>
								</td>
							</tr>
							@endforeach
							@endif
						</tbody>
					</table>
				</div>
			</div>
			<!-- /.card-footer-->
		</div>
		<!-- /.card -->
	</div>
</section>
<!-- /.content -->
@endsection

@section('fscripts')
<!-- DataTables -->
<script src="{{ asset('cpanel/vendor/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('cpanel/vendor/datatables/dataTables.bootstrap4.js') }}"></script>
<!-- Page Script -->
<script>
$(document).ready(function() {
    var table = $('#table-data').DataTable({
		"bFilter": false
	});
});
</script>
@endsection
