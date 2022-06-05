@extends("content.page.layouts.theme")

@section("page_title", "Data Laporan")

@section("page_header") 
<a href="{{ url('/page/laporan_perhari') }}" class="btn btn-bitbucket btn-sm">
	Laporan Perhari
</a>
@stop

@section("page_breadcrumb")

<ol class="breadcrumb">
	<li><a href="{{ url('/page/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
	<li class="active">Data Laporan</li>
</ol>

@stop

@section("page_content")

@if(Auth::user()->role == 1)
<div class="row">
	<div class="col-xs-12">
		<div class="box box-info">
			<div class="box-header">
				<div class="row">
					<div class="col-md-10">
						<h3 class="box-title"><i class="fa fa-folder-open"></i> Total Absen Keseluruhan Siswa</h3>
					</div>
					<div class="col-md-2">
						<a class="btn btn-primary btn-sm" href="{{ url('/page/lihat_data_laporan_keseluruhan') }}">
							<i class="fa fa-search"></i>
							Lihat Data Print
						</a>
					</div>
				</div>
			</div>
			<div class="box-body" id="print-1">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th class="text-center">No.</th>
							<th class="text-center">NIS</th>
							<th>Nama</th>
							<th class="text-center">Kelas</th>
							<th class="text-center">Hadir</th>
							<th class="text-center">Sakit</th>
							<th class="text-center">Izin</th>
							<th class="text-center">Alfa</th>
							<th class="text-center">Terlambat</th>
						</tr>
					</thead>
					<tbody>
						@php $no = 0 @endphp

						@foreach($data_absen_siswa as $siswa)
						<tr>
							<td class="text-center">{{ ++$no }}.</td>
							<td class="text-center">{{ $siswa->nis }}</td>
							<td>{{ $siswa->nama }}</td>
							<td class="text-center">{{ $siswa->kelas->nama_kelas }}</td>
							<td class="text-center">
								<?php
								$hadir = DB::table("absen")
								->join("siswa", "absen.nis_siswa", "=", "siswa.nis")
								->where("absen_status", 1)
								->where("nis", $siswa->nis)
								->count();
								echo $hadir;
								?>
							</td>
							<td class="text-center">
								<?php
								$sakit = DB::table("absen")
								->join("siswa", "absen.nis_siswa", "=", "siswa.nis")
								->where("absen_status", 2)
								->where("nis", $siswa->nis)
								->count();
								echo $sakit;
								?>
							</td>
							<td class="text-center">
								<?php
								$izin = DB::table("absen")
								->join("siswa", "absen.nis_siswa", "=", "siswa.nis")
								->where("absen_status", 3)
								->where("nis", $siswa->nis)
								->count();
								echo $izin;
								?>
							</td>
							<td class="text-center">
								<?php
								$alfa = DB::table("absen")
								->join("siswa", "absen.nis_siswa", "=", "siswa.nis")
								->where("absen_status", 4)
								->where("nis", $siswa->nies)
								->count();
								echo $alfa;
								?>
							</td>
							<td class="text-center">
								<?php
								$terlambat = DB::table("absen")
								->join("siswa", "absen.nis_siswa", "=", "siswa.nis")
								->where("absen_status", 5)
								->where("nis", $siswa->nis)
								->count();
								echo $terlambat;
								?>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<div class="pull-right">
					{{ $data_absen_siswa->links() }}
				</div>
			</div>
		</div>
	</div>
</div>
@elseif(Auth::user()->role == 2)
<div class="row">
	<div class="col-xs-12">
		<div class="box box-info">
			<div class="box-header">
				<div class="row">
					<div class="col-md-9">
						<h3 class="box-title">Data Laporan Keseluruhan Siswa <b>{{ $kelas->nama_kelas }}</b></h3>
					</div>
					<div class="col-md-3">
						<a href="{{ url('/page/lihat_keseluruhan_laporan_perkelas') }}" class="btn btn-primary btn-sm">
							<i class="fa fa-search"></i> Lihat Laporan Keseluruhan
						</a>
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
							<th class="text-center">Hadir</th>
							<th class="text-center">Sakit</th>
							<th class="text-center">Izin</th>
							<th class="text-center">Alfa</th>
							<th class="text-center">Terlambat</th>
						</tr>
					</thead>
					<tbody>
						@php $no = 0 @endphp

						@forelse($data_siswa as $siswa)
						<tr>
							<td class="text-center">{{ ++$no }}.</td>
							<td class="text-center">{{ $siswa->nis }}</td>
							<td>{{ $siswa->nama }}</td>
							<td class="text-center">{{ $siswa->kelas->nama_kelas }}</td>
							<td class="text-center">
								<?php
								$hadir = DB::table("absen")
								->join("siswa", "absen.nis_siswa", "=", "siswa.nis")
								->where("absen_status", 1)
								->where("nis", $siswa->nis)
								->count();
								echo $hadir;
								?>
							</td>
							<td class="text-center">
								<?php
								$sakit = DB::table("absen")
								->join("siswa", "absen.nis_siswa", "=", "siswa.nis")
								->where("absen_status", 2)
								->where("nis", $siswa->nis)
								->count();
								echo $sakit;
								?>
							</td>
							<td class="text-center">
								<?php
								$izin = DB::table("absen")
								->join("siswa", "absen.nis_siswa", "=", "siswa.nis")
								->where("absen_status", 3)
								->where("nis", $siswa->nis)
								->count();
								echo $izin;
								?>
							</td>
							<td class="text-center">
								<?php
								$alfa = DB::table("absen")
								->join("siswa", "absen.nis_siswa", "=", "siswa.nis")
								->where("absen_status", 4)
								->where("nis", $siswa->nis)
								->count();
								echo $alfa;
								?>
							</td>
							<td class="text-center">
								<?php
								$terlambat = DB::table("absen")
								->join("siswa", "absen.nis_siswa", "=", "siswa.nis")
								->where("absen_status", 5)
								->where("nis", $siswa->nis)
								->count();
								echo $terlambat;
								?>
							</td>
						</tr>
						@empty
						<tr>
							<td colspan="9" class="text-center">
								<b>
									<i> Data Saat Ini Masih Kosong</i>
								</b>
							</td>
						</tr>
						@endforelse
					</tbody>
					<tfoot>
						<tr>
							<td colspan="9" class="text-center">
								Wali Kelas : <b>{{ Auth::user()->name }}</b>
							</td>
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

@else

@endif

@endsection