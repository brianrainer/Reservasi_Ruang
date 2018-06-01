
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">room</i>            
            <select name='room' required>
              <option value="" disabled>Choose Room</option>
              @foreach ($rooms as $room)
                <option value='{{$room->id}}'> {{$room->room_code}} ({{$room->room_name}}) </option>
              @endforeach
            </select>
            <label for="room">Ruangan</label>
            <span class="helper-text">
              Pilih Ruangan yang akan Anda Gunakan
              <i class="material-icons tiny tooltipped" data-position="bottom" data-tooltip="Pastikan ruangan yang akan Anda gunakan tersedia">help</i>
            </span>
          </div>
        </div>
