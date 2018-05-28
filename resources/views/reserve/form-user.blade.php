        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">account_circle</i>
            <input type="text" value="{{ old('full_name') }}" id="full_name" name="full_name" maxlength="100" class="validate" required>
            <label for="full_name">Nama Lengkap</label>
            <span class="helper-text" data-error="Nama Lengkap harus berupa string maksimal 100 karakter" data-success="">
              Masukkan Nama Lengkap Anda (max. 100 karakter)
              <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Nama Anda diperlukan untuk mempermudah konfirmasi reservasi">help</i>
            </span>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix"></i>
            <input type="text" value="{{ old('nrp_nip') }}" id="nrp_nip" name="nrp_nip" class="validate" pattern="[0-9]{10,20}">
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
            <input type="text" value="{{ old('phone_number') }}" name="phone_number" class="validate" pattern="[0-9]{8,12}" required>
            <label for="phone_number">Nomor Telepon</label>
            <span class="helper-text" data-error="Nomor Telepon harus berupa angka 8-12 digit">
              Masukkan Nomor Telepon Anda
              <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Pastikan nomor telepon Anda dapat dihubungi">help</i>
            </span>
          </div>
          <div class="input-field col s12 m6">
            <i class="material-icons prefix">email</i>
            <input type="email" value="{{ old('email') }}" name="email" class="validate" required>
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
            <select name="agency" required>
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