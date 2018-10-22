<div class="row">
  <div class="input-field col s12">
    <i class="material-icons prefix">date_range</i>
    <input type="text" value="{{ old('start_date') }}" class="datepicker" id="start_date" name="start_date" class="validate" required>
    <label for="start_date">Tanggal</label>
    <span class="helper-text">
      Pilih Tanggal Acara Anda (Format: YYYY-MM-DD)
      <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Pastikan hari yang anda pilih sesuai dengan syarat dan ketentuan">help</i>
    </span>
  </div>
</div>


<div class="row">
  <div class="input-field col s12 m6">
    <i class="material-icons prefix">access_time</i>
    <input type="text" value="{{ old('start_time') }}" class="timepicker" id="start_time" name="start_time" class="validate" required>
    <label for="start_time">Waktu Mulai</label>
    <span class="helper-text">
      Pilih Waktu Mulai Acara
      <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Pastikan waktu yang anda pilih sesuai dengan syarat dan ketentuan">help</i>
    </span>
  </div>
  
  <div class="input-field col s12 m6">
    <i class="material-icons prefix"></i>
    <input type="text" value="{{ old('end_time') }}" class="timepicker" id="end_time" name="end_time" class="validate" required>
    <label for="end_time">Waktu Selesai</label>
    <span class="helper-text">
      Pilih Waktu Selesai Acara
      <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Pastikan waktu yang anda pilih sesuai dengan syarat dan ketentuan">help</i>
    </span>
  </div>
</div>