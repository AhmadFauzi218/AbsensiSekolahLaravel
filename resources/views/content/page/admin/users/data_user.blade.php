@extends("content.page.layouts.theme")

@section("page_title", "Data Users")

@section("page_header") 
<i class="fa fa-users"></i> Data Users
@stop

@section("page_breadcrumb")

<ol class="breadcrumb">
	<li><a href="{{ url('/page/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
	<li class="active">Data Users</li>
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
	<div class="col-xs-4">
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title"><i class="fa fa-plus"></i> Tambah Data </h3>
			</div>
			<div class="box-body">
				<form method="POST" action="{{ url('/page/simpan_data_users') }}">
					{{ csrf_field() }}
					<div class="form-group">
						<label class="control-label"> Name </label>
						<input type="text" class="form-control" name="name" placeholder="Masukkan Name">
					</div>
					<div class="form-group">
						<label class="control-label"> Username </label>
						<input type="text" class="form-control" name="username" placeholder="Masukkan Username">
					</div>
					<div class="form-group">
						<label class="control-label"> Password </label>
						<input type="password" class="form-control" name="password" placeholder="Masukkan Password">
					</div>
					<hr>
					<div class="form-group">
						<button type="submit" class="btn btn-success btn-sm btn-block">
							<i class="fa fa-plus"></i> Tambah
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	@foreach($data_users as $user)
	<div class="col-xs-4">
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title"><i class="fa fa-pencil"></i> Update Data </h3>
			</div>
			<div class="box-body">
				<form method="POST" action="{{ url('/page/users') }}">
					{{ csrf_field() }}
					{{ method_field("PUT") }}
					<input type="hidden" name="id" value="{{ $user->id }}">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"> Name </label>
								<input type="text" class="form-control" name="name" placeholder="Masukkan Name" value="{{ $user->name }}">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label"> Username </label>
								<input type="text" class="form-control" name="username" placeholder="Masukkan Username" value="{{ $user->username }}">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label"> Password </label>
						<input type="password" class="form-control" name="password" placeholder="Masukkan Password">
					</div>
					<div class="form-group">
						<label class="control-label"> Konfirmasi Password </label>
						<input type="password" class="form-control" name="konfirmasi_password" placeholder="Konfirmasi Password">
					</div>
					<hr>
					<div class="form-group">
						<button type="submit" class="btn btn-info btn-sm btn-block">
							<i class="fa fa-save"></i> Simpan
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	@endforeach
</div>

@endsection