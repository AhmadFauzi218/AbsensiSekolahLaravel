<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label class="control-label"> NIS </label>
			<input type="text" class="form-control" name="nis" placeholder="Masukkan NIS" value="{{ $edit->nis }}" readonly autocomplete="off">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="control-label"> Nama </label>
			<input type="text" class="form-control" name="nama" placeholder="Masukkan Nama" value="{{ $edit->nama }}" autocomplete="off">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-4">
		<div class="form-group">
			<label class="control-label"> Nama Kelas </label>
			<select class="form-control" name="id_kelas">
				<option value="" disabled selected>- Pilih -</option>
				@foreach($data_kelas as $kelas)
					@if($edit->id_kelas == $kelas->id)
					<option value="{{ $kelas->id }}" selected>
						{{ $kelas->nama_kelas }}
					</option>
					@else
					<option value="{{ $kelas->id }}">
						{{ $kelas->nama_kelas }}
					</option>
					@endif
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label class="control-label"> No. Telepon </label>
			<input type="text" class="form-control" name="no_telp" placeholder="Masukkan No. Telepon" value="{{ $edit->no_telp }}" autocomplete="off">
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label class="control-label"> Jenis Kelamin </label>
			<select class="form-control" name="jenis_kelamin">
				<option value="" disabled selected>- Pilih -</option>
				@if($edit->jenis_kelamin == "Laki - Laki")
				<option value="Laki - Laki" selected>Laki - Laki</option>
				<option value="Perempuan">Perempuan</option>
				@elseif($edit->jenis_kelamin == "Perempuan")
				<option value="Laki - Laki">Laki - Laki</option>
				<option value="Perempuan" selected>Perempuan</option>
				@else
				<option value="Laki - Laki">Laki - Laki</option>
				<option value="Perempuan">Perempuan</option>
				@endif
			</select>
		</div>
	</div>
</div>
<div class="form-group">
	<label class="control-label">Alamat</label>
	<textarea class="form-control" name="alamat" placeholder="Masukkan Alamat" rows="4">{{ $edit->alamat }}</textarea>
</div>