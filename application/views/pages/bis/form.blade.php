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
                <h1>{{ @$info ? 'Ubah' : 'Tambah' }} Bis <small></small></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ site_url('') }}">Beranda</a></li>
					<li class="breadcrumb-item"><a href="{{ site_url('bis') }}">Bis</a></li>
                    <li class="breadcrumb-item active">{{ @$info ? 'Ubah' : 'Tambah' }} Bis</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <form role="form" action="{{ @$info ? site_url('bis/update/'.$info->PlatNomor) : site_url('bis/store') }}" enctype="multipart/form-data" method="POST">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-{{ @$info ? 'warning' : 'primary' }}">
                        <div class="card-header">
                            <h3 class="card-title">Bis</h3>
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
                                        <label for="PlatNomor">Plat Nomor (Spasi Diganti dengan Underscore)</label>
                                        <input id="platnomor" type="text" class="form-control" name="PlatNomor" placeholder="Plat Nomor (Bis)" value="{{ @$info ? @$info->PlatNomor : '' }}" {{ @$info ? 'readonly' : '' }}>
									</div>
									<div class="form-group">
                                        <label for="IdBisJenis">Jenis Bis</label>
                                        <select class="form-control" name="IdBisJenis">
											@if(@$info_bisjenis)
											@foreach ($info_bisjenis as $info_data)
											<option value="{{ @$info_data->IdBisJenis }}" {{ (@$info_data->IdBisJenis==@$info->IdBisJenis) ? 'selected' : '' }}>{{ @$info_data->NamaJenis }}</option>
											@endforeach
											@else
											<option value="">-- JENIS BIS TIDAK TERSEDIA --</option>
											@endif
										</select>
									</div>
									<div class="form-group">
                                        <label for="NamaBis">Nama Bis</label>
                                        <input type="text" class="form-control" name="NamaBis" placeholder="Merk, Tipe atau Model Bis" value="{{ @$info ? @$info->NamaBis : '' }}">
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
			$("#platnomor").on('input', function(key) {
				var value = $(this).val();
				$(this).val(value.replace(/ /g, '_').toUpperCase());
			})
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
