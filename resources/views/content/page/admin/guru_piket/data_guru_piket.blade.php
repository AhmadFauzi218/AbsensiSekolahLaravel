@extends("content.page.layouts.theme")

@section("page_title", "Data Guru Piket")

@section("page_header") 
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-info"><i class="fa fa-plus"></i> Tambah Data </button> 
@stop

@section("page_breadcrumb")

<ol class="breadcrumb">
	<li><a href="{{ url('/page/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
	<li class="active">Data Guru Piket</li>
</ol>

@stop

@section("page_scripts")

<script type="text/javascript">
	function edit_guru_piket(id) {
		$.ajax({
			url : "{{ url('/page/edit_guru_piket') }}",
			type : "GET",
			data : { id : id },
			success : function(data) {
				$("#modal-content").html(data);
				return true;
			}
		});
	}
</script>

@endsection


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

@if(session("error"))
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-danger" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<strong>Gagal!</strong> {{ session("error") }}.
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
				<h3 class="box-title"><i class="fa fa-pencil"></i> Data Guru Piket </h3>
			</div>
			<div class="box-body">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th class="text-center">No.</th>
							<th class="text-center">Nama Guru Piket</th>
							<th class="text-center">Hari</th>
							<th class="text-center">Status Jadwal Piket</th>
							<th class="text-center">Aksi</th>
						</tr>
					</thead>
					<tbody>
						@php $no = 0 @endphp

						@foreach($data_guru_piket as $guru_piket)
						<tr>
							<td class="text-center">{{ ++$no }}.</td>
							<td class="text-center">{{ $guru_piket->guru->nama }}</td>
							<td class="text-center">{{ $guru_piket->hari }}</td>
							<td class="text-center">
								@if($guru_piket->status == 1)
								Aktif
								@elseif($guru_piket->status == 0)
								Tidak Aktif
								@else
								Tidak Jelas
								@endif
							</td>
							<td class="text-center">
								<button onclick="edit_guru_piket({{$guru_piket->id}})" type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-warning"><i class="fa fa-pencil"></i> Edit </button>
								<a onclick="return confirm('Yakin ? Ingin Menghapus Data Ini ?')" href="{{ url('/page/hapus_data_guru_piket/'.$guru_piket->guru->nip) }}" class="btn btn-danger btn-sm">
									<i class="fa fa-trash-o"></i> Hapus
								</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
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
			<form method="POST" action="{{ url('/page/simpan_data_guru_piket') }}">
				{{ csrf_field() }}
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"> Nama Guru </label>
								<select class="form-control" name="nip_guru">
									<option value="" disabled selected>- Pilih -</option>
									@foreach($data_guru as $guru)
									<option value="{{ $guru->nip }}">
										{{ $guru->nama }}
									</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"> Hari </label>
								<select class="form-control" name="hari">
									<option value="" disabled selected>- Pilih -</option>
									<option value="Senin">Senin</option>
									<option value="Selasa">Selasa</option>
									<option value="Rabu">Rabu</option>
									<option value="Kamis">Kamis</option>
									<option value="Jum'at">Jum'at</option>
								</select>
							</div>
						</div>
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

<div class="modal fade" id="modal-warning">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title"><i class="fa fa-pencil"></i> Update Data</h4>
			</div>
			<form method="POST" action="{{ url('/page/update_data_guru_piket') }}">
				{{ csrf_field() }}
				{{ method_field('PUT') }}
				<div class="modal-body" id="modal-content">
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-sign-out"></i> Close</button>
					<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan </button>
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

@endsection