<div class="row">
  <div class="input-field col s12 m6">
    <i class="material-icons prefix"></i>
    <select id="routine" name="routine" required>
      @foreach ($routines as $routine)
        <option value="{{$routine->repeat_in_sec}}">{{$routine->routine_name}}</option>
      @endforeach
    </select>
    <label for="routine">Rutinitas</label>
    <span class="helper-text">
      Pilihlah jeda rutinitas kegiatan Anda
      <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Pastikan rutinitas yang anda pilih benar">help</i>
    </span> 
  </div>
  
  <div class="input-field col s12 m6">
    <i class="material-icons prefix"></i> 
    <input type="number" id="howmanytimes" name="howmanytimes" value="1" min="1" max="20" value="{{old('howmanytimes')}}" required>
    <label for="howmanytimes">Berapa kali</label>
    <span class="helper-text">
      Masukkan banyak perulangan peminjaman
      <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Minimum perulangan adalah sekali (1x) dan maksimum perulangan adalah dua puluh kali (20x)">help</i>
    </span>
  </div>
</div>