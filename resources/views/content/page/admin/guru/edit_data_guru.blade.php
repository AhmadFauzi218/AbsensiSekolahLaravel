<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label class="control-label"> NIP </label>
			<input type="text" class="form-control" name="nip" placeholder="Masukkan NIP" value="{{ $edit->nip }}" readonly>
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
	<div class="col-md-6">
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
	<div class="col-md-6">
		<div class="form-group">
			<label class="control-label"> No. HP </label>
			<input type="text" class="form-control" name="no_hp" placeholder="Masukkan No. HP" value="{{ $edit->no_hp }}" autocomplete="off">
		</div>
	</div>
</div>
<div class="form-group">
	<label class="control-label"> Alamat </label>
	<textarea class="form-control" name="alamat" placeholder="Masukkan Alamat" rows="5">{{ $edit->alamat }}</textarea>
</div>