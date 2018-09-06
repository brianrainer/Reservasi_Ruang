            <div class="col s12 m6 l4">
              <div class="card">
                <div class="card-image waves-effect waves-block waves-light">
                  @if ($room->room_imagepath)
                    <img src="{{$room->room_imagepath}}">
                  @endif
                </div>
                <div class="card-content">
                  <span class="card-title activator gray-text text-darken-4">
                    {{ $room->room_code }} {{ $room->room_name }} <i class="material-icons right">more_vert</i>
                  </span>
                  <p>
                    <a href="{{url('/agenda/'.$room->room_code)}}">Check Status</a>
                  </p>
                  <p>
                    <a href="{{url('/room/detail/'.$room->room_code)}}">Edit Room</a>
                  </p>
                </div>
                <div class="card-reveal">
                  <span class="card-title activator gray-text text-darken-4">
                    {{ $room->room_code }} {{ $room->room_name }}<i class="material-icons right">close</i>
                  </span>
                  <p>
                    Teknisi: 
                    {{-- @if ($room->technicians()->count())
                    @endif --}}
                  </p>
                </div>
              </div>
            </div>