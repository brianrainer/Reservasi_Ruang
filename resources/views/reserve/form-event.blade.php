<div class="row">
  <div class="input-field col s12">
    <i class="material-icons prefix">event</i>
    <input type="text" value="{{ $title }}" name="title" id="event_title" class="validate" required>
    <label for="event_title">Nama Acara</label>
    <span class="helper-text">
      Masukkan Nama Acara Anda
      <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Pilhlah judul yang singkat, padat, dan jelas.">help</i>
    </span>
  </div>
</div>


<div class="row">
  <div class="input-field col s12">
    <i class="material-icons prefix">view_quilt</i>
    <select id="category" name='category' required>
      @foreach ($categories as $category)
        <option value="{{$category->id}}">{{$category->category_name}}</option>
      @endforeach
    </select>
    <label for="category">Kategori Acara</label>
    <span class="helper-text">
      Pilih Kategori Acara Anda
      <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Kategori digunakan untuk mempermudah pencarian reservasi">help</i>
    </span>
  </div>
</div>


<div class="row">
  <div class="input-field col s12">
    <i class="material-icons prefix">event_note</i>
    <textarea id='event_description' name='event_description' class='materialize-textarea' data-length='180' required>{{ $event_description }}</textarea>
    <label for="event_description">Deskripsi Acara</label>
    <span class="helper-text">
      Berikan Deskripsi Singkat untuk Acara Anda
      <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Deskripsi Acara diperlukan untuk mempermudah konfirmasi reservasi">help</i>
    </span>
  </div>
</div>


<div class="row">
  <div class="file-field input-field col s12">
    <div class="btn waves-effect waves-light blue darken-4">
      <span>Gambar</span>
      <input type="file" name="poster_imagepath" id="poster_imagepath">
    </div>
    <div class="file-path-wrapper">
      <input type="text" class="file-path validate" placeholder="Upload File Poster">
    </div>
    <span class="helper-text">
      Opsional. Apabila ada, poster kegiatan akan dipajang di monitor di depan ruangan
      <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Ukuran maksimal poster adalah 5MB">help</i>
    </span>
  </div>
</div>


<div class="row">
  <div class="input-field col s12">
    <p>
      <label>
        <input type="checkbox" name="agree" class="filled-in" required>
        <span>
          Saya sudah membaca dan setuju dengan 
          <a href="{{url('/')}}">Syarat dan Ketentuan Reservasi</a> 
        </span>
      </label>
    </p>
  </div>
</div>


<div class="row">
  <div class="col s12">
    <button class="btn waves-effect waves-light right blue darken-4" type="submit" name="action">
      Submit <i class="material-icons right">send</i>
    </button>
  </div>
</div>
