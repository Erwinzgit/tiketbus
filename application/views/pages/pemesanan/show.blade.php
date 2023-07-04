@extends('layouts.panel')

@section('hstyles')

@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tampil Pemesanan #{{ @$info->IdPemesanan }}<small></small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ site_url('') }}">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ site_url('info/wadah') }}">Pemesanan</a></li>
                        <li class="breadcrumb-item active">Tampil Pemesanan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
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
                                            <td>{{ $info->IdPemesanan }}</td>
                                        </tr>
                                        <tr>
                                            <td>Nomor Identitas</td>
                                            <td>{{ $info->NoIdentitas }}</td>
                                        </tr>
                                        <tr>
                                            <td>ID Jadwal</td>
                                            <td>{{ $info->IdJadwal }}</td>
                                        </tr>
                                        <tr>
                                            <td>ID Admin</td>
                                            <td>{{ $info->IdAdmin }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah Penumpang</td>
                                            <td>{{ $info->JumlahPenumpang }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Pesan</td>
                                            <td>{{ $info->TanggalPesan }}</td>
										</tr>
										<tr>
                                            <td>Tanggal Berangkat</td>
                                            <td>{{ $info->TanggalBerangkat }}</td>
										</tr>
										<tr>
											<td>Pemesanan Kursi</td>
											<td>
												<span>ID Kursi</span>
												<ul>
													@foreach ($info2 as $info_data)
													<li>{{ $info_data2->IdKursi }}</li>
													@endforeach	
												</ul>
											</td>
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
            <div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Pemesanan Kursi</h3>
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fa fa-minus"></i></button>
							<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
								<i class="fa fa-times"></i></button>
						</div>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-6">
								<a href="{{ site_url('pemesanan/kursi/create') }}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Tambah Pemesanan Baru</a>
							</div>
							<div class="col-md-6">
								<div class="float-right">
									<label for="filter">
										<select id="table-data-filter-column" class="form-control form-control-sm">
											<option>ID Pemesanan Kursi</option>
											<option>ID Kursi</option>
										</select>
									</label>
								</div>
							</div>
						</div>
						<div class="row">
							<table id="table-data" class="table table-bordered table-striped text-center table-responsive-sm">
								<thead>
									<tr>
										<th>ID Pemesanan Kursi</th>
										<th>ID Kursi</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									@foreach($info2 as $info_data)
									<tr>
										<td>{{ $info_data->IdPemesananKursi }}</td>
										<td>{{ $info_data->IdKursi }}</td>
										<td>
											<a href="{{ site_url('pemesanan/kursi/edit/'.$info_data->IdPemesananKursi) }}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Ubah</a> | 
											<a href="{{ site_url('pemesanan/kursi/destroy/'.$info_data->IdPemesananKursi) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</a>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>
    </section>
@endsection

@section('fscripts')
<!-- DataTables -->
<script src="{{ asset('cpanel/vendor/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('cpanel/vendor/datatables/dataTables.bootstrap4.js') }}"></script>
<!-- Page Script -->
<script>
    var table = $('#table-data').DataTable();

    $('.dataTables_filter input').unbind().bind('keyup', function() {
        var colIndex = document.querySelector('#table-data-filter-column').selectedIndex;
        table.column(colIndex).search(this.value).draw();
    });
</script>
@endsection
