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
				<h1>Data Kursi Bis</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ site_url('') }}">Beranda</a></li>
					<li class="breadcrumb-item active">Data Kursi Bis</li>
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
					<h3 class="card-title">Kursi Bis</h3>
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
						<div class="col-md-6">
							<div class="row">
								<div class="col-8">
									<form action="{{ site_url('kursi/generate') }}" method="POST">
										<div class="row">
											<div class="col-sm-3">
												<input class="form-control form-control-sm" type="text" name="total" placeholder="Jumlah" />
											</div>
											<div class="col-sm-6">
												<select class="form-control form-control-sm" name="PlatNomor">
													@if(@$info_bis)
													@foreach ($info_bis as $info_data)
													<option value="{{ @$info_data->PlatNomor }}" {{ (@$info_data->PlatNomor==@$info->PlatNomor) ? 'selected' : '' }}>{{ @$info_data->PlatNomor }} ({{ @$info_data->NamaBis }})</option>
													@endforeach
													@else
													<option value="">-- BIS TIDAK TERSEDIA --</option>
													@endif
												</select>
											</div>
											<div class="col-sm-3">
												<button type="submit" class="btn btn-sm btn-info"><i class="fa fa-cog" aria-hidden="true"></i> Buat</button>
											</div>
										</div>
									</form>
								</div>
								<div class="col-4">
									<a href="{{ site_url('kursi/create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Kursi Bis Baru</a>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="float-right">
								<label for="filter">
									<select id="table-data-filter-column" class="form-control form-control-sm">
										<option>ID Kursi</option>
										<option>Bis (Plat Nomor)</option>
										<option>Nomor Kursi</option>
										<option>Status Kursi</option>
									</select>
								</label>
							</div>
						</div>
					</div>
					<div class="row">
						<table id="table-data"
							class="table table-bordered table-striped text-center table-responsive-sm">
							<thead>
								<tr>
									<th>ID Kursi</th>
									<th>Bis (Plat Nomor)</th>
									<th>Nomor Kursi</th>
									<th>Status Kursi</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								@foreach($info as $info_data)
								<tr>
									<td>{{ $info_data->IdKursi }}</td>
									<td>{{ $info_data->PlatNomor }}</td>
									<td>{{ $info_data->NoKursi }}</td>
									<td>{{ $info_data->StatusKursi }}</td>
									<td>
										<!-- <a href="{{ site_url('kursi/edit/'.$info_data->IdKursi) }}"
											class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Ubah</a> | -->
										<a href="{{ site_url('kursi/destroy/'.$info_data->IdKursi) }}"
											class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</a>
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
	$(document).ready(function () {
		var groupColumn = 1;
		var table = $('#table-data').DataTable({
			"columnDefs": [{
				"visible": false,
				"targets": groupColumn
			}],
			"order": [
				[groupColumn, 'asc']
			],
			"displayLength": 25,
			"drawCallback": function (settings) {
				var api = this.api();
				var rows = api.rows({
					page: 'current'
				}).nodes();
				var last = null;

				api.column(groupColumn, {
					page: 'current'
				}).data().each(function (group, i) {
					if (last !== group) {
						$(rows).eq(i).before(
							'<tr class="group"><td colspan="5" style="background: #0069D9; color: white"><b>Plat Nomor: ' + group + '</b></td></tr>'
						);

						last = group;
					}
				});
			}
		});

		// Order by the grouping
		$('#table-data tbody').on('click', 'tr.group', function () {
			var currentOrder = table.order()[0];
			if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
				table.order([groupColumn, 'desc']).draw();
			} else {
				table.order([groupColumn, 'asc']).draw();
			}
		});

		$('.dataTables_filter input').unbind().bind('keyup', function () {
			var colIndex = document.querySelector('#table-data-filter-column').selectedIndex;
			table.column(colIndex).search(this.value).draw();
		});
	});

</script>
@endsection
