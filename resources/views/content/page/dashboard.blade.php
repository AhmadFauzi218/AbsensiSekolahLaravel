@extends("content.page.layouts.theme")

@section("page_title", "Dashboard")

@section("page_header") <i class="fa fa-dashboard"></i> Dashboard @stop

@section("page_breadcrumb")

<ol class="breadcrumb">
	<li><a href="{{ url('/page/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Dashboard</li>
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

<div class="row">
	<div class="col-xs-12">
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title">Selamat Datang <b>{{ Auth::user()->name }} </b></h3>
			</div>
			<div class="box-body">
				<p>
					di <strong>{{ config("app.myapp") }} Siswa Berbasis Web.</strong>. Silahkan pilih menu untuk memulai program.
				</p>

			</div>
		</div>
	</div>
</div>

@if(Auth::user()->role == 1)
<div class="row">
	<div class="col-lg-3 col-xs-6">
		<div class="small-box bg-aqua">
			<div class="inner">
				<h3>{{ $total_guru }}</h3>

				<p>Data Guru</p>
			</div>
			<div class="icon">
				<i class="fa fa-users"></i>
			</div>
			<a href="{{ url('/page/guru') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<div class="col-lg-3 col-xs-6">
		<div class="small-box bg-aqua">
			<div class="inner">
				<h3>{{ $total_kelas }}</h3>

				<p>Data Kelas</p>
			</div>
			<div class="icon">
				<i class="fa fa-map-marker"></i>
			</div>
			<a href="{{ url('/page/kelas') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<div class="col-lg-3 col-xs-6">
		<div class="small-box bg-aqua">
			<div class="inner">
				<h3>{{ $total_siswa }}</h3>

				<p>Data Siswa</p>
			</div>
			<div class="icon">
				<i class="fa fa-user"></i>
			</div>
			<a href="{{ url('/page/siswa') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<div class="col-lg-3 col-xs-6">
		<div class="small-box bg-aqua">
			<div class="inner">
				<h3>{{ $total_guru_piket }}</h3>

				<p>Data Guru Piket</p>
			</div>
			<div class="icon">
				<i class="fa fa-pencil"></i>
			</div>
			<a href="{{ url('/page/guru_piket') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
</div>
@elseif(Auth::user()->role == 2)
<div class="row">
	<div class="col-md-6">
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title"><i class="fa fa-pencil"></i> Data Absen</h3>
			</div>
			<div class="box-body">
				<div id="chart"></div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="box box-info">
			<div class="box-header">
				<div class="row">
					<div class="col-md-6">
						<h3 class="box-title"><i class="fa fa-map-marker"></i> Siswa yang Belum Absen</h3>
					</div>
					<div class="col-md-6">
						<div class="pull-right">
							<a href="{{ url('/page/tambah_absen') }}" class="btn btn-success btn-sm">
								<i class="fa fa-sign-in"></i> Pergi ke menu Absen
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="box-body">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th class="text-center">No.</th>
							<th class="text-center">NIS</th>
							<th>Nama</th>
						</tr>
					</thead>
					<tbody>
						@php $no = 0 @endphp

						@foreach($data_siswa as $siswa)
						<?php
						$date = date("Y-m-d");
						$absen = DB::table("absen")
						->where("nis_siswa", $siswa->nis)
						->where("absen_date", $date)
						->first();
						?>
						@if($absen == "")
						<tr>
							<td class="text-center">{{ ++$no }}.</td>
							<td class="text-center">{{ $siswa->nis }}</td>
							<td>{{ $siswa->nama }}</td>
						</tr>
						@endif

						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endif

@endsection

@section("page_scripts")
<script src="{{ url('/public/js/chart.js') }}"></script>

<script type="text/javascript">
	Highcharts.chart('chart', {
		chart: {
			type: 'column'
		},
		title: {
			text: 'Rating Absen '
		},
		xAxis: {
			categories: [
			'Hadir',
			'Sakit',
			'Izin',
			'Alfa',
			'Terlambat'
			],
			crosshair: true
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Total Absen'
			}
		},
		tooltip: {
			headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
			pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
			'<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
			footerFormat: '</table>',
			shared: true,
			useHTML: true
		},
		plotOptions: {
			column: {
				pointPadding: 0.2,
				borderWidth: 0
			}
		},
		<?php
		$hadir = DB::table("absen")->where("absen_status", 1)->count();
		$sakit = DB::table("absen")->where("absen_status", 2)->count();
		$izin = DB::table("absen")->where("absen_status", 3)->count();
		$alfa = DB::table("absen")->where("absen_status", 4)->count();
		$terlambat = DB::table("absen")->where("absen_status", 5)->count();
		?>
		series: [{
			name: 'Absen',
			data: [{{$hadir}}, {{$sakit}}, {{$izin}}, {{$alfa}}, {{$terlambat}}]

		}]
	});
</script>

@endsection