<div class="row">
  <div class="input-field col s12 m6">
    <i class="material-icons prefix">account_circle</i>
    <input type="text" value="{{ $full_name }}" id="full_name" name="full_name" maxlength="100" class="validate" required>
    <label for="full_name">Nama Lengkap</label>
    <span class="helper-text" data-error="Nama Lengkap harus berupa string maksimal 100 karakter" data-success="">
      Masukkan Nama Lengkap Anda (max. 100 karakter)
      <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Nama Anda diperlukan untuk mempermudah konfirmasi reservasi">help</i>
    </span>
  </div>

  <div class="input-field col s12 m6">
    <i class="material-icons prefix"></i>
    <input type="text" value="{{ $nrp_nip }}" id="nrp_nip" name="nrp_nip" class="validate" pattern="[0-9]{10,20}">
    <label for="nrp_nip">NRP / NIP</label>
    <span class="helper-text">
      Masukkan NRP bila Anda Mahasiswa, atau NIP bila Anda Dosen
      <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Gunakan NRP dengan format baru">help</i>
    </span>
  </div>
</div>


<div class="row">
  <div class="input-field col s12 m6">
    <i class="material-icons prefix">phone</i>
    <input type="text" value="{{ $phone_number }}" id="phone_number" name="phone_number" class="validate" pattern="[0-9]{8,12}" required>
    <label for="phone_number">Nomor Telepon</label>
    <span class="helper-text" data-error="Nomor Telepon harus berupa angka 8-12 digit">
      Masukkan Nomor Telepon Anda
      <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Pastikan nomor telepon Anda dapat dihubungi">help</i>
    </span>
  </div>

  <div class="input-field col s12 m6">
    <i class="material-icons prefix">email</i>
    <input type="email" value="{{ $email }}" name="email" id="email" class="validate" required>
    <label for="email">Email</label>
    <span class="helper-text" data-error="Email harus menggunakan format email yang benar">
      Masukkan Email Anda
      <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Pastikan email Anda dapat dihubungi">help</i>
    </span>
  </div>
</div>


<div class="row">
  <div class="input-field col s12">
    <i class="material-icons prefix">group</i>
    <select id="agency" name="agency" required>
      <option value="" disabled>Choose Agency</option>
      @foreach ($agencies as $agency)
        <option value="{{$agency->id}}">{{$agency->agency_name}}</option>
      @endforeach
    </select>
    <label for="agency">Organisasi yang Diwakilkan</label>
    <span class="helper-text">
      Pilih Organisasi yang Anda Wakilkan
      <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Organisasi digunakan untuk mempermudah pencarian pengajuan reservasi">help</i>
    </span>
  </div>
</div>


<div class="row">
  <div class="input-field col s12 m6">
    <i class="material-icons prefix">person_outline</i>
    <input type="text" id="pic_title_1" name="pic_title_1" value="{{ $pic_title_1 }}" class="validate" required>
    <label for="pic_title_1">Jabatan</label>
    <span class="helper-text">
      Contoh: Ketua Himpunan Mahasiswa Teknik Informatika Periode 20XX -20XX
      <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Penanggung Jawab Kegiatan diperlukan dalam pembuatan Surat Ijin Peminjaman">help</i>
    </span>
  </div>

  <div class="input-field col s12 m6">
    <i class="material-icons prefix"></i>
    <input type="text" id="pic_name_1" name="pic_name_1" value="{{ $pic_name_1 }}" class="validate" required>
    <label for="pic_name_1">Nama Penanggung Jawab Utama</label>
    <span class="helper-text">
      Gunakan Nama Lengkap
      <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Penanggung Jawab Kegiatan secara otomatis akan disertakan dalam Surat Ijin Peminjaman">help</i>
    </span>
  </div>

  <div class="input-field col s12 m6">
    <i class="material-icons prefix"></i>
    <input type="text" id="pic_title_2" name="pic_title_2" value="{{ $pic_title_2 }}" class="validate">
    <label for="pic_title_2">Jabatan</label>
    <span class="helper-text">
      Contoh: Ketua Panitia Pelaksana Kegiatan
      <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Opsional. Penanggung Jawab dengan Jabatan lebih tinggi harap dicantumkan sebagai Penanggung Jawab Utama">help</i>
    </span>
  </div>

  <div class="input-field col s12 m6">
    <i class="material-icons prefix"></i>
    <input type="text" id="pic_name_2" name="pic_name_2" value="{{ $pic_name_2 }}" class="validate">
    <label for="pic_name_2">Nama Penanggung Jawab Sekunder</label>
    <span class="helper-text">
      Gunakan Nama Lengkap
      <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Penanggung Jawab Kegiatan secara otomatis akan disertakan dalam Surat Ijin Peminjaman">help</i>
    </span>
  </div>
</div>