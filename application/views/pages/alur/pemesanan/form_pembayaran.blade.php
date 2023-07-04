@extends('layouts.panel')

@section('hstyles')
    <link rel="stylesheet" href="{{ asset('cpanel/vendor/bootstrap-datetimepicker/tempusdominus-bootstrap-4.min.css') }}" />
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Alur Pemesanan (Bagian Terakhir) <small></small></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ site_url('') }}">Beranda</a></li>
					<li class="breadcrumb-item">Alur Pemesanan</li>
                    <li class="breadcrumb-item active">Pembayaran</li>
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
					<li><a href="#">Kursi</a></li>
                    <li class="active"><span>Pembayaran</span></li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card card-info">
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
		<div class="row">
			<div class="col-md-4 col-sm-6">
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
					<div class="card-body">
						<div class="row">
							<div class="col-12">
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
					</div>
				</div>
			</div>
			<div class="col-md-8 col-sm-6">
				<form role="form" action="{{ site_url('alur/pemesanan/store_pembayaran') }}" enctype="multipart/form-data" method="POST">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Pembayaran</h3>
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
                                        <label for="TotalBayar">Total Pembayaran</label>
                                        <input id="totalbayar" type="text" class="form-control" name="TotalBayar" value="{{ $info_total_bayar->TotalBayar }}" readonly>
									</div>
									<div class="form-group">
                                        <label for="Bayar">Bayar (ISI INI TERLEBIH DAHULU)</label>
                                        <input id="bayar" type="text" class="form-control" name="Bayar" value="0">
									</div>
									<div class="form-group">
                                        <label for="Kembalian">Kembalian</label>
										<input id="kembalian" type="text" class="form-control" name="Kembalian" value="Isi dulu input Bayar dengan benar" readonly>
										<input type="hidden" class="form-control" name="Status" value="Lunas" readonly>
									</div>
                                </div>
                            </div>
                        </div>
                        <div id="btnSubmitForm" class="card-footer">
                            <button type="submit" class="btn btn-primary">Selesai</button>
                        </div>
                    </div>
					<!-- /.card -->
				</form>
			</div>
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
	<script>
		$('#btnSubmitForm').hide();
		$('#bayar').on('input', function() {
			var input_totalbayar = $('#totalbayar').val();
			var input_bayar = $(this).val();
			var kembalian = input_bayar - input_totalbayar;
			if (kembalian < 0) {
				$('#kembalian').val('Belum Valid');
				$('#btnSubmitForm').slideUp("slow");
			} else {
				$('#kembalian').val(kembalian);
				$('#btnSubmitForm').slideDown("slow");
			}
		});
	</script>
@endsection
