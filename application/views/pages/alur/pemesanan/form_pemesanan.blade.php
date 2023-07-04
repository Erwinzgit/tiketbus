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
                <h1>Alur Pemesanan (Bagian 2) <small></small></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ site_url('') }}">Beranda</a></li>
					<li class="breadcrumb-item">Alur Pemesanan</li>
                    <li class="breadcrumb-item active">Pemesanan</li>
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
                    <li class="active"><span>Pemesanan</span></li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <form role="form" action="{{ site_url('alur/pemesanan/store_pemesanan') }}" enctype="multipart/form-data" method="POST">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Pemesanan</h3>
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
                                        <label for="NoIdentitas">Nomor Identitas</label>
                                        <input type="text" class="form-control" name="NoIdentitas" value="{{ $this->session->info_alur_pemesan }}" readonly>
									</div>
									<div class="form-group">
                                        <label for="IdJadwal">Jadwal</label>
                                        <select class="form-control" name="IdJadwal">
											@if(@$info_jadwal)
											@foreach ($info_jadwal as $info_data)
											<option value="{{ @$info_data->IdJadwal }}" {{ (@$info_data->IdJadwal==@$info->IdJadwal) ? 'selected' : '' }}>Rute: {{ @$info_data->IdRute }}, PlatNomor: {{ @$info_data->PlatNomor }}, Waktu: {{ @$info_data->Waktu }}</option>
											@endforeach
											@else
											<option value="">-- JADWAL TIDAK TERSEDIA --</option>
											@endif
										</select>
									</div>
									<div class="form-group">
                                        <label for="IdAdmin">Admin (Karyawan)</label>
                                        <select class="form-control" name="IdAdmin">
											<option value="{{ @$info_admin->IdAdmin }}">{{ @$info_admin->Username }} - ({{ @$info_admin->NamaLengkap }})</option>
										</select>
									</div>
									<div class="form-group">
                                        <label for="JumlahPenumpang">Jumlah Penumpang</label>
                                        <input type="text" class="form-control" name="JumlahPenumpang" placeholder="Jumlah Penumpang">
									</div>
									<div class="form-group">
                                        <label for="TanggalPesan">Tanggal Pesan</label>
										<div class="form-group">
											<div class="input-group date" id="tanggalpesan" data-target-input="nearest">
												<input type="text" name="TanggalPesan" placeholder="Tanggal Pesan" class="form-control datetimepicker-input" data-target="#tanggalpesan" readonly/>
												<div class="input-group-append" data-target="#tanggalpesan" data-toggle="datetimepicker">
													<div class="input-group-text"><i class="fa fa-calendar"></i></div>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
                                        <label for="TanggalBerangkat">Tanggal Berangkat</label>
                                        <div class="form-group">
											<div class="input-group date" id="tanggalberangkat" data-target-input="nearest">
												<input type="text" name="TanggalBerangkat" placeholder="Tanggal Berangkat" class="form-control datetimepicker-input" data-target="#tanggalberangkat" readonly/>
												<div class="input-group-append" data-target="#tanggalberangkat" data-toggle="datetimepicker">
													<div class="input-group-text"><i class="fa fa-calendar"></i></div>
												</div>
											</div>
										</div>
										<input type="hidden" class="form-control" name="StatusPemesanan" value="Dipesan">
									</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Tambah & Lanjut</button>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </form>
    </div>
</section>
<!-- /.content -->
@endsection

@section('fscripts')
    <script type="text/javascript">
        $(function () {
            $('#tanggalpesan').datetimepicker({
                format : 'YYYY-MM-DD',
                ignoreReadonly: true
            });
			$('#tanggalberangkat').datetimepicker({
                format : 'YYYY-MM-DD',
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
@endsection
