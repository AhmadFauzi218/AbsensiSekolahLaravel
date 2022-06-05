@extends("content.page.layouts.theme")

@section("page_title", "Data Absen")

@section("page_header") 
<i class="fa fa-pencil"></i> Update Data Absen
@stop

@section("page_breadcrumb")

<ol class="breadcrumb">
	<li><a href="{{ url('/page/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
	<li class="active">Update Data Absen</li>
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
				<h3 class="box-title"><i class="fa fa-folder-open"></i> Absen Siswa </h3>
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

						@forelse($data_absen as $absen)
						<tr>
							<td class="text-center">{{ ++$no }}.</td>
							<td class="text-center">{{ $absen->siswa->nis }}</td>
							<td>{{ $absen->siswa->nama }}</td>
							<td class="text-center">{{ $absen->siswa->kelas->nama_kelas }}</td>
							<form method="POST" action="{{ url('/page/update_data_absen') }}">
								{{ csrf_field() }}
								{{ method_field('PUT') }}
								<input type="hidden" name="id" value="{{ $absen->id }}">
								<input type="hidden" name="nis_siswa" value="{{ $absen->nis_siswa }}">
								<td class="text-center">
									<select class="form-control" name="absen_status">
										<option value="" disabled>- Pilih -</option>
										@if($absen->absen_status == 1)
										<option value="1" selected>Hadir</option>
										<option value="2">Sakit</option>
										<option value="3">Izin</option>
										<option value="4">Alfa</option>
										@elseif($absen->absen_status == 2)
										<option value="1">Hadir</option>
										<option value="2" selected>Sakit</option>
										<option value="3">Izin</option>
										<option value="4">Alfa</option>
										@elseif($absen->absen_status == 3)
										<option value="1">Hadir</option>
										<option value="2">Sakit</option>
										<option value="3" selected>Izin</option>
										<option value="4">Alfa</option>
										@elseif($absen->absen_status == 4)
										<option value="1">Hadir</option>
										<option value="2">Sakit</option>
										<option value="3">Izin</option>
										<option value="4" selected>Alfa</option>
										@else
										<option value="5" selected>Terlambat</option>
										@endif
									</select>
								</td>
								<td class="text-center">
									<input type="date" class="form-control" name="absen_date" value="{{ $absen->absen_date }}">
								</td>
								<td class="text-center">
									<input type="text" class="form-control" name="keterangan" placeholder="Masukkan Keterangan" value="{{ $absen->keterangan }}">
								</td>
								@if($absen->absen_status == 5)
								<td class="text-center">
									<button disabled class="btn btn-info btn-sm">
										<i class="fa fa-save"></i> Simpan
									</button>
								</td>
								@else
								<td class="text-center">
									<button type="submit" class="btn btn-info btn-sm">
										<i class="fa fa-save"></i> Simpan
									</button>
								</td>
								@endif
							</form>
						</tr>
						@empty
						<tr>
							<td class="text-center" colspan="7">
								<b>
									<i> Data Saat Ini Masih Kosong</i>
								</b>
							</td>
						</tr>
						@endforelse
					</tbody>
					<tfoot>
						<tr>
							<td colspan="6">
								Wali Kelas : <b>{{ Auth::user()->name }}</b>
							</td>
							<td class="text-center">
								Total Siswa : <b>{{ $total }}</b>
							</td>
						</tr>
					</tfoot>
				</table>
				<div class="pull-right">
					{{ $data_absen->links() }}
				</div>
			</div>
		</div>
	</div>
</div>

@endsection