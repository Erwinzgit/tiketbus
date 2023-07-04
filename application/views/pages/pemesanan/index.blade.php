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
                <h1>Data Pemesanan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ site_url('') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Data Pemesanan</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
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
						<div class="col-md-6">
							<a href="{{ site_url('alur/pemesanan/pemesan') }}" class="btn btn-primary btn-xs"><span class="fa fa-plus"></span> Tambah Alur Pemesanan</a>
						</div>
                        <div class="col-md-6">
                            <div class="float-right">
                                <label for="filter">
                                    <select id="table-data-filter-column" class="form-control form-control-sm">
										<option>ID Pemesanan</option>
										<option>Pemesan (Nomor Identitas)</option>
										<option>Jadwal (ID Jadwal)</option>
										<option>Admin (ID Admin)</option>
										<option>Jumlah Penumpang</option>
										<option>Tanggal Pesan</option>
										<option>Tanggal Berangkat</option>
                                    </select>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <table id="table-data" class="table table-bordered table-striped text-center table-responsive-sm">
                            <thead>
                                <tr>
									<th>ID Pemesanan</th>
									<th>Pemesan (Nomor Identitas)</th>
									<th>Jadwal (ID Jadwal)</th>
									<th>Admin (ID Admin)</th>
									<th>Jumlah Penumpang</th>
									<th>Tanggal Pesan</th>
									<th>Tanggal Berangkat</th>
									<th>Status Pemesanan</th>
									<th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
								@foreach($info as $info_data)
                                <tr>
									<td>{{ $info_data->IdPemesanan }}</td>
									<td>{{ $info_data->NoIdentitas }}</td>
									<td>{{ $info_data->IdJadwal }}</td>
									<td>{{ $info_data->IdAdmin }}</td>
									<td>{{ $info_data->JumlahPenumpang }}</td>
									<td>{{ $info_data->TanggalPesan }}</td>
									<td>{{ $info_data->TanggalBerangkat }}</td>
									<td>{{ $info_data->StatusPemesanan }}</td>
									<td>
											<!-- <a href="{{ site_url('pemesanan/show/'.$info_data->IdPemesanan) }}" class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Tampil</a>
										<a href="{{ site_url('pemesanan/edit/'.$info_data->IdPemesanan) }}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Ubah</a> -->
										<a href="{{ site_url('pemesanan/destroy/'.$info_data->IdPemesanan) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</a>
                                    </td>
								</tr>
								@endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
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
    var table = $('#table-data').DataTable();

    $('.dataTables_filter input').unbind().bind('keyup', function() {
        var colIndex = document.querySelector('#table-data-filter-column').selectedIndex;
        table.column(colIndex).search(this.value).draw();
    });
} );
</script>
@endsection
