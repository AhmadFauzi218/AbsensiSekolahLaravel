@extends("content.page.layouts.theme")

@section("page_title", "Tambah Absen")

@section("page_header") 
<i class="fa fa-plus"></i> Tambah Absen
@stop

@section("page_breadcrumb")

<ol class="breadcrumb">
	<li><a href="{{ url('/page/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
	<li class="active">Tambah Absen</li>
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
				<div class="row">
					<div class="col-md-10">
						<h3 class="box-title"> Absensi Siswa <b>{{ $kelas->nama_kelas }} | Tanggal : {{ date("d - m - Y") }}</b> 
						</h3>
					</div>
					<div class="col-md-2">
						<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-info">
							<i class="fa fa-plus"></i> Absen Pertanggal 
						</button> 
					</div>
				</div>
			</div>
			<div class="box-body">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th class="text-center">No.</th>
							<th class="text-center">NIS</th>
							<th>Nama</th>
							<th class="text-center">Kelas</th>
							<th class="text-center">Status Absen</th>
							<th class="text-center">Tanggal Absen</th>
							<th class="text-center">Keterangan</th>
							<th class="text-center">Aksi</th>
						</tr>
					</thead>
					<tbody>
						@php $no = 0 @endphp

						@forelse($data_siswa as $siswa)

						<?php
						$date = date("Y-m-d");
						$absen = DB::table("absen")
						->where("nis_siswa", $siswa->nis)
						->where("absen_date", $date)
						->first();
						?>
						<tr>
							<td class="text-center">{{ ++$no }}.</td>
							<td class="text-center">{{ $siswa->nis }}</td>
							<td>{{ $siswa->nama }}</td>
							<td class="text-center">{{ $siswa->kelas->nama_kelas }}</td>
							<form method="POST" action="{{ url('/page/simpan_data_absen') }}">
								{{ csrf_field() }}
								<input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
								<input type="hidden" name="nis_siswa" value="{{ $siswa->nis }}">
								<td class="text-center">
									<select class="form-control" name="absen_status">
										<option value="" disabled selected>- Pilih -</option>
										<option value="1">Hadir</option>
										<option value="2">Sakit</option>
										<option value="3">Izin</option>
										<option value="4">Alfa</option>
									</select>
								</td>
								<td class="text-center">
									<?php
										$date = date("Y-m-d");
									?>
									<input type="date" class="form-control" name="absen_date" value="{{ $date }}" readonly style="background-color: white;">
								</td>
								<td class="text-center">
									<input type="text" class="form-control" name="keterangan" placeholder="Masukkan Keterangan" autocomplete="off">
								</td>
								@if($absen !== NULL)
								<td class="text-center">
									<button disabled class="btn btn-success btn-sm">
										<i class="fa fa-thumbs-up"></i> Sudah Absen
									</button>
								</td>
								@else
								<td class="text-center">
									<button type="submit" class="btn btn-success btn-sm">
										<i class="fa fa-plus"></i> Absen
									</button>
								</td>
								@endif
							</form>
						</tr>
						@empty
						<tr>
							<td class="text-center" colspan="7">
								<b>
									<i>Data Saat Ini Masih Kosong</i>
								</b>
							</td>
						</tr>
						@endforelse
					</tbody>
					<tfoot>
						<tr>
							<td colspan="6"	>
								<b>
									Wali Kelas : {{ Auth::user()->name }}
								</b>
							</td>
							<td class="text-center">Total Siswa : {{ $total }}</td>
						</tr>
						
					</tfoot>
				</table>
				<div class="pull-right">
					{{ $data_siswa->links() }}
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-info">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title"><i class="fa fa-plus"></i> Tambah Data</h4>
			</div>
			<form method="POST" action="{{ url('/page/simpan_data_absen') }}">
				{{ csrf_field() }}
				<input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
				<div class="modal-body">
					<div class="form-group">
						<label class="control-label" for="nis_siswa"> Nama Siswa </label>
						<select class="form-control" id="nis_siswa" name="nis_siswa">
							<option value="" disabled selected>- Pilih -</option>
							@foreach($data_siswa as $siswa)
							<option value="{{ $siswa->nis }}">
								{{ $siswa->nama }}
							</option>
							@endforeach
						</select>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label" for="tgl_absen"> Tanggal Absen </label>
								<input type="date" id="tgl_absen" class="form-control" name="absen_date">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label" for="absen_status"> Absen Status </label>
								<select class="form-control" id="absen_status" name="absen_status">
									<option value="" disabled selected>- Pilih -</option>
									<option value="1">Hadir</option>
									<option value="2">Sakit</option>
									<option value="3">Izin</option>
									<option value="4">Alfa</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label" for="keterangan"> Keterangan </label>
						<textarea class="form-control" id="keterangan" name="keterangan" rows="5" placeholder="Masukkan Keterangan"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-sign-out"></i> Close</button>
					<button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah </button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection