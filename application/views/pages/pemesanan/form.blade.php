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
                <h1>{{ @$info ? 'Ubah' : 'Tambah' }} Pemesanan <small></small></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ site_url('') }}">Beranda</a></li>
					<li class="breadcrumb-item"><a href="{{ site_url('pemesanan') }}">Pemesanan</a></li>
                    <li class="breadcrumb-item active">{{ @$info ? 'Ubah' : 'Tambah' }} Pemesanan</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <form role="form" action="{{ @$info ? site_url('pemesanan/update/'.$info->id) : site_url('pemesanan/store') }}" enctype="multipart/form-data" method="POST">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-{{ @$info ? 'warning' : 'primary' }}">
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
                                        <select class="form-control" name="NoIdentitas">
											@if(@$info_pemesan)
											@foreach ($info_pemesan as $info_data)
											<option value="{{ @$info_data->NoIdentitas }}" {{ (@$info_data->NoIdentitas==@$info->NoIdentitas) ? 'selected' : '' }}>{{ @$info_data->NoIdentitas }}, Nama: {{ @$info_data->NamaPemesan }}</option>
											@endforeach
											@else
											<option value="">-- PEMESAN TIDAK TERSEDIA --</option>
											@endif
										</select>
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
											@if(@$info_admin)
											@foreach ($info_admin as $info_data)
											<option value="{{ @$info_data->IdAdmin }}" {{ (@$info_data->IdAdmin==@$info->IdAdmin) ? 'selected' : '' }}>Username: {{ @$info_data->Username }}, Nama Lengkap: {{ @$info_data->NamaLengkap }}</option>
											@endforeach
											@else
											<option value="">-- ADMIN TIDAK TERSEDIA --</option>
											@endif
										</select>
									</div>
									<div class="form-group">
                                        <label for="JumlahPenumpang">Jumlah Penumpang</label>
                                        <input type="text" class="form-control" name="JumlahPenumpang" placeholder="Jumlah Penumpang" value="{{ @$info ? @$info->JumlahPenumpang : '' }}">
									</div>
									<div class="form-group">
                                        <label for="TanggalPesan">Tanggal Pesan</label>
                                        <input id="tanggalpesan" type="text" class="form-control" name="TanggalPesan" placeholder="Tanggal Pesan" value="{{ @$info ? @$info->TanggalPesan : '' }}">
									</div>
									<div class="form-group">
                                        <label for="TanggalBerangkat">Tanggal Berangkat</label>
                                        <input id="tanggalberangkat" type="text" class="form-control" name="TanggalBerangkat" placeholder="Tanggal Berangkat" value="{{ @$info ? @$info->TanggalBerangkat : '' }}">
									</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-{{ @$info ? 'warning' : 'primary' }}">Submit</button>
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
                format : 'YYYY-MM-DD hh:mm:ss',
                ignoreReadonly: true
            });
			$('#tanggalberangkat').datetimepicker({
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
@endsection
