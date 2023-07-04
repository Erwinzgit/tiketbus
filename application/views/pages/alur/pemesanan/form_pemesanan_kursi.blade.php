@extends('layouts.panel')

@section('hstyles')
	<!-- DataTables -->
	<link rel="stylesheet" href="{{ asset('cpanel/vendor/datatables/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('cpanel/vendor/bootstrap-datetimepicker/tempusdominus-bootstrap-4.min.css') }}" />
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Alur Pemesanan (Bagian 3) <small></small></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ site_url('') }}">Beranda</a></li>
					<li class="breadcrumb-item">Alur Pemesanan</li>
                    <li class="breadcrumb-item active">Pemesanan Kursi</li>
                </ol>
            </div>
		</div>
		<div class="row">
            <div class="col-sm-12">
                <hr class="separator">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="d-flex justify-content-center align-items-center">
                    <h5>Cara untuk membuat alur pemesanan:</h5>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <ol class="breadcrumb arr-bread d-flex justify-content-center align-items-center">
                    <li><a href="#">Alur Data</a></li>
					<li><a href="#">Pemesan</a></li>
					<li><a href="#">Pemesanan</a></li>
                    <li class="active"><span>Pemesanan Kursi</span></li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
		<div class="row">
			<!-- left column -->
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-6">
						<form role="form" action="{{ site_url('alur/pemesanan/store_pemesanan_kursi') }}" enctype="multipart/form-data" method="POST">
							<!-- general form elements -->
							<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title">Pemesanan Kursi</h3>
									<div class="card-tools">
										<button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
											<i class="fa fa-minus"></i></button>
										<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
											<i class="fa fa-times"></i></button>
									</div>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<div class="row">
										<div class="col-lg-12">
											<div class="form-group">
												<label for="IdPemesanan">Pemesanan</label>
												<input type="text" class="form-control" value="{{ $this->session->info_alur_pemesanan }}" name="IdPemesanan" readonly>
											</div>
											<div class="form-group">
												<label for="IdKursi">Kursi (Nomor Kursi)</label>
												<select class="form-control" name="IdKursi">
													@if(@$info_kursi_tersedia)
													@foreach ($info_kursi_tersedia as $info_data)
													<option value="{{ @$info_data->IdKursi }}">NoKursi: {{ @$info_data->NoKursi }}</option>
													@endforeach
													@else
													<option value="">-- KURSI TIDAK TERSEDIA --</option>
													@endif
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="card-footer">
									<button type="submit" class="btn btn-warning" name="submitForm" value="loop">Tambah & Ulangi</button> | 
									<button type="submit" class="btn btn-primary" name="submitForm">Tambah & Lanjut</button>
								</div>
							</div>
							<!-- /.card -->
						</form>
					</div>
					<div class="col-md-6">
						<div class="card card-info">
							<div class="card-header">
								<h3 class="card-title">Daftar Pesanan Kursi</h3>
								<div class="card-tools">
									<button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip"
										title="Collapse">
										<i class="fa fa-minus"></i></button>
									<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip"
										title="Remove">
										<i class="fa fa-times"></i></button>
								</div>
							</div>
							<!-- /.card-header -->
							<div class="card-body">
								<div class="row">
									<table id="table-data" class="table table-bordered table-striped text-center table-responsive-sm">
										<thead>
											<tr>
												<th>Nomor Kursi</th>
											</tr>
										</thead>
										<tbody>
											@php
												$i = 1;
											@endphp
											@if(@$info_pesanan_kursi)
											@foreach($info_pesanan_kursi as $info_data)
											<tr>
												<td>{{ $info_data->NoKursi }}</td>
											</tr>
											@endforeach
											@endif
										</tbody>
									</table>
								</div>
							</div>
							<!-- /.card-body -->
						</div>
						<!-- /.card -->
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="card card-warning">
							<div class="card-header">
								<h3 class="card-title"><b>Detail Pemesanan</b></h3>
								<div class="card-tools">
									<button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
										<i class="fa fa-minus"></i></button>
									<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
										<i class="fa fa-times"></i></button>
								</div>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-md-12">
										<table class="table table-user-information">
											<tbody>
												<tr>
													<td>ID Pemesanan</td>
													<td>{{ $info_pemesanan->IdPemesanan }}</td>
												</tr>
												<tr>
													<td>Nomor Identitas</td>
													<td>{{ $info_pemesanan->NoIdentitas }}</td>
												</tr>
												<tr>
													<td>ID Jadwal</td>
													<td>{{ $info_pemesanan->IdJadwal }}</td>
												</tr>
												<tr>
													<td>ID Admin</td>
													<td>{{ $info_pemesanan->IdAdmin }}</td>
												</tr>
												<tr>
													<td>Jumlah Penumpang</td>
													<td>{{ $info_pemesanan->JumlahPenumpang }}</td>
												</tr>
												<tr>
													<td>Tanggal Pesan</td>
													<td>{{ $info_pemesanan->TanggalPesan }}</td>
												</tr>
												<tr>
													<td>Tanggal Berangkat</td>
													<td>{{ $info_pemesanan->TanggalBerangkat }}</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /.col -->
        </div>
    </div>
</section>
<!-- /.content -->
@endsection

@section('fscripts')
    <script type="text/javascript">
        $(function () {
            $('#datetimepicker1').datetimepicker({
                format : 'YYYY-MM-DD hh:mm:ss',
                ignoreReadonly: true
            });
        });
    </script>
    <script type="text/javascript" src="{{ asset('cpanel/vendor/bootstrap-datetimepicker/moment.js') }}"></script>
    <script type="text/javascript" src="{{ asset('cpanel/vendor/bootstrap-datetimepicker/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- CK Editor -->
    <script type="text/javascript" src="{{ asset('cpanel/vendor/ckeditor/ckeditor.js') }}"></script>
    <script>
        $(function () {
            ClassicEditor
            .create(document.querySelector('#body-editor'))
            .then(function (editor) {
                // The editor instance
            })
            .catch(function (error) {
                console.error(error)
            })
        })
	</script>
	<!-- DataTables -->
	<script src="{{ asset('cpanel/vendor/datatables/jquery.dataTables.js') }}"></script>
	<script src="{{ asset('cpanel/vendor/datatables/dataTables.bootstrap4.js') }}"></script>
	<!-- Page Script -->
	<script>
		$(document).ready(function () {
			var table = $('#table-data').DataTable({
				"bFilter": false
			});
		});
	</script>
@endsection
