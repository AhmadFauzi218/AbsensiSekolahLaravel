<input type="hidden" name="id" value="{{ $edit->id }}">
<input type="hidden" name="nip_lama" value="{{ $edit->nip_guru }}">
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label class="control-label"> Nama Guru </label>
			<select class="form-control" name="nip_guru">
				<option value="" disabled>- Pilih -</option>
				@foreach($data_guru as $guru)
					@if($edit->nip_guru == $guru->nip)
					<option value="{{ $guru->nip }}" selected>
						{{ $guru->nama }}
					</option>
					@else
					<option value="{{ $guru->nip }}">
						{{ $guru->nama }}
					</option>
					@endif
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="control-label"> Hari </label>
			<select class="form-control" name="hari">
				<option value="" disabled>- Pilih -</option>
				@if($edit->hari == "Senin")
				<option value="Senin" selected>Senin</option>
				<option value="Selasa">Selasa</option>
				<option value="Rabu">Rabu</option>
				<option value="Kamis">Kamis</option>
				<option value="Jum'at">Jum'at</option>
				@elseif($edit->hari == "Selasa")
				<option value="Senin">Senin</option>
				<option value="Selasa" selected>Selasa</option>
				<option value="Rabu">Rabu</option>
				<option value="Kamis">Kamis</option>
				<option value="Jum'at">Jum'at</option>
				@elseif($edit->hari == "Rabu")
				<option value="Senin">Senin</option>
				<option value="Selasa">Selasa</option>
				<option value="Rabu" selected>Rabu</option>
				<option value="Kamis">Kamis</option>
				<option value="Jum'at">Jum'at</option>
				@elseif($edit->hari == "Kamis")
				<option value="Senin">Senin</option>
				<option value="Selasa">Selasa</option>
				<option value="Rabu">Rabu</option>
				<option value="Kamis" selected>Kamis</option>
				<option value="Jum'at">Jum'at</option>
				@elseif($edit->hari == "Jum'at")
				<option value="Senin">Senin</option>
				<option value="Selasa">Selasa</option>
				<option value="Rabu">Rabu</option>
				<option value="Kamis">Kamis</option>
				<option value="Jum'at" selected>Jum'at</option>
				@else
				<option value="Senin">Senin</option>
				<option value="Selasa">Selasa</option>
				<option value="Rabu">Rabu</option>
				<option value="Kamis">Kamis</option>
				<option value="Jum'at">Jum'at</option>
				@endif
			</select>
		</div>
	</div>
</div>