@extends("content.page.layouts.theme")

@section("page_title", "Tambah Absen Terlambat")

@section("page_header") 
<i class="fa fa-plus"></i> Tambah Absen Siswa Terlambat
@stop

@section("page_breadcrumb")

<ol class="breadcrumb">
	<li><a href="{{ url('/page/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
	<li class="active">Tambah Absen Siswa Terlambat</li>
</ol>

@stop


@section("page_content")

@if(session("sukses"))
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-success" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<strong>Berhasil!</strong> {{ session("sukses") }}.
		</div>
	</div>
</div>
@endif

@if(count($errors) > 0)
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
				<li>
					{{ $error }}
				</li>
				@endforeach
			</ul>
		</div>
	</div>
</div>
@endif

<div class="row">
	<div class="col-xs-12">
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title"> Absen Siswa Terlambat </h3>
			</div>
			<div class="box-body">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th class="text-center">No.</th>
							<th class="text-center">NIS</th>
							<th>Nama</th>
							<th class="text-center">Kelas</th>
							<th class="text-center">Absen Status</th>
							<th class="text-center">Keterangan</th>
							<th class="text-center">Aksi</th>
						</tr>
					</thead>
					<tbody>
						@php $no = 0 @endphp

						@foreach($data_siswa as $siswa)
						<?php
							$date = date("Y-m-d");
							$absen = DB::table("absen")
								->join("siswa", "absen.nis_siswa", "=", "siswa.nis")
								->where("nis_siswa", $siswa->nis)
								->where("absen_date", $date)
								->first();
						?>
						@if($absen == "")
						<tr>
							<td class="text-center">{{ ++$no }}.</td>
							<td class="text-center">{{ $siswa->nis }}</td>
							<td>{{ $siswa->nama }}</td>
							<td class="text-center">{{ $siswa->kelas->nama_kelas }}</td>
							<form method="POST" action="{{ url('/page/simpan_data_absen_terlambat') }}">
								{{ csrf_field() }}
								<input type="hidden" name="nis_siswa" value="{{ $siswa->nis }}">
								<td class="text-center">
									<select class="form-control" name="absen_status">
										<option value="5">Terlambat</option>
									</select>
								</td>
								<td class="text-center">
									<input type="text" class="form-control" name="keterangan" placeholder="Masukkan Keterangan" autocomplete="off">
								</td>
								<td class="text-center">
								<?php
									$waktu = date("H:i:s");
									$waktu_awal_absen = date("07:00:00");
									$waktu_akhir_absen = date("09:00:00");

									if (($waktu >= $waktu_awal_absen) && ($waktu <= $waktu_akhir_absen)) {
									?>
										<button type="submit" class="btn btn-success btn-sm">
											<i class="fa fa-plus"></i> Absen
										</button>
									<?php
										} else {
									?>
										<button disabled class="btn btn-success btn-sm">
											<i class="fa fa-map-marker"></i> Tidak Ada Absen
										</button>
									<?php
										}
									?>
								</td>
							</form>
						</tr>
						@endif
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection