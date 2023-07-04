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
                <h1>{{ @$info ? 'Ubah' : 'Tambah' }} Jadwal <small></small></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ site_url('') }}">Beranda</a></li>
					<li class="breadcrumb-item"><a href="{{ site_url('jadwal') }}">Jadwal</a></li>
                    <li class="breadcrumb-item active">{{ @$info ? 'Ubah' : 'Tambah' }} Jadwal</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <form role="form" action="{{ @$info ? site_url('jadwal/update/'.$info->IdJadwal) : site_url('jadwal/store') }}" enctype="multipart/form-data" method="POST">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-{{ @$info ? 'warning' : 'primary' }}">
                        <div class="card-header">
                            <h3 class="card-title">Jadwal</h3>
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
                                        <label for="IdRute">Rute</label>
                                        <select class="form-control" name="IdRute">
											@if(@$info_rute)
											@foreach ($info_rute as $info_data)
											<option value="{{ @$info_data->IdRute }}" {{ (@$info_data->IdRute==@$info->IdRute) ? 'selected' : '' }}>{{ @$info_data->Asal }} - {{ @$info_data->Tujuan }}</option>
											@endforeach
											@else
											<option value="">-- RUTE TIDAK TERSEDIA --</option>
											@endif
										</select>
									</div>
									<div class="form-group">
										<label for="PlatNomor">Plat Nomor (Bis)</label>
										<select class="form-control" name="PlatNomor" id="">
											@if(@$info_bis)
											@foreach ($info_bis as $info_data)
											<option value="{{ @$info_data->PlatNomor }}" {{ (@$info_data->PlatNomor==@$info->PlatNomor) ? 'selected' : '' }}>{{ @$info_data->PlatNomor }} ({{ @$info_data->NamaBis }})</option>
											@endforeach
											@else
											<option value="">-- BIS TIDAK TERSEDIA --</option>
											@endif
										</select>
									</div>
									<div class="form-group">
                                        <label for="Waktu">Waktu Keberangkatan</label>
										<div class="input-group date" id="time" data-target-input="nearest">
											<input type="text" class="form-control datetimepicker-input" name="Waktu" value="{{ @$info_data->Waktu }}" data-target="#time" readonly/>
											<div class="input-group-append" data-target="#time" data-toggle="datetimepicker">
												<div class="input-group-text"><i class="fa fa-clock-o"></i></div>
											</div>
										</div>
									</div>
									<div class="form-group">
                                        <label for="Waktu">Biaya Perjalanan</label>
                                        <input type="text" class="form-control" name="BiayaPerjalanan" placeholder="Biaya Perjalanan" value="{{ @$info ? @$info->BiayaPerjalanan : '' }}">
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
            $('#time').datetimepicker({
				format: 'HH:mm:ss',
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
