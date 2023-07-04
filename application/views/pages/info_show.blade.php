@extends('layouts.panel')

@section('hstyles')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('cpanel/vendor/datatables/dataTables.bootstrap4.css') }}">
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tampil Informasi Pemesanan Keberangkatan #{{ $info_detail->IdPemesanan }}<small></small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ site_url('beranda') }}">Beranda</a></li>
                        <li class="breadcrumb-item active">Tampil Informasi Pemesanan Keberangkatan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><b>Informasi Pemesanan Keberangkatan</b></h3>
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
                                            <td>Waktu Jam Berangkat</td>
                                            <td>{{ $info_detail->Waktu }}</td>
                                        </tr>
                                        <tr>
                                            <td>Rute</td>
                                            <td>{{ $info_detail->Asal }} -> {{ $info_detail->Tujuan }}</td>
                                        </tr>
                                        <tr>
                                            <td>Plat Nomor (Bis)</td>
                                            <td>{{ $info_detail->PlatNomor }}</td>
										</tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
			<div class="col-6">
				<div class="card card-secondary">
					<div class="card-header">
						<h3 class="card-title">Detail Kursi Pesanan</h3>
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
							<div class="col-sm-12">
								<div class="row">
									<div class="col-sm-12">
										<div class="row">
											
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<table id="table-data" class="table table-bordered text-center table-responsive-sm">
								<thead class="bg bg-secondary">
									<tr>
										<th>Nama Pemesan</th>
										<th>Nomor Kursi</th>
									</tr>
								</thead>
								<tbody>
									@if(@$info_pesanan_kursi)
									@foreach ($info_pesanan_kursi as $info_data)
									<tr>
										<td>{{ $info_data->NamaPemesan }}</td>
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
		<div class="row">
			
		</div>
		<!-- /.row -->
	</div>
    </section>
@endsection

@section('fscripts')
<!-- DataTables -->
<script src="{{ asset('cpanel/vendor/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('cpanel/vendor/datatables/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('cpanel/vendor/datatables/dataTables.rowsGroup.js') }}"></script>
<!-- Page Script -->
<script>
	var groupColumn = 0;
    var table = $('#table-data').DataTable({
		"bFilter": false,
		"pageLength": 5,
		"lengthMenu": [[5, 10, -1], [5, 10, "All"]],
        "order": [[ groupColumn, 'asc' ]],
        "displayLength": 25,
        'rowsGroup': [0]
    });

    // Order by the grouping
    $('#table-data tbody').on('click', 'tr.group', function() {
        var currentOrder = table.order()[0];
        if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
            table.order([ groupColumn, 'desc' ]).draw();
        } else {
            table.order([ groupColumn, 'asc' ]).draw();
        }
    });
</script>
@endsection
