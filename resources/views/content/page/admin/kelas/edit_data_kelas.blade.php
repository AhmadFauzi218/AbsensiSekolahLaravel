<input type="hidden" name="id" value="{{ $edit->id }}">
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label class="control-label"> Nama Kelas </label>
			<input type="text" class="form-control" name="nama_kelas" placeholder="Masukkan Nama Kelas" value="{{ $edit->nama_kelas }}" autocomplete="off">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="control-label"> Nama Wali Kelas </label>
			<select class="form-control" name="nip_wali_kelas">
				<option value="" disabled>- Pilih -</option>
				@foreach($data_guru as $guru)
					@if($edit->nip_wali_kelas == $guru->nip)
					<option value="{{ $guru->nip }}" selected>
						{{ $guru->nama }}
					</option>
					@else
						@if($guru->kelas == "")
						<option value="{{ $guru->nip }}">
							{{ $guru->nama }}
						</option>
						@endif
					@endif
				@endforeach
			</select>
		</div>
	</div>
</div>