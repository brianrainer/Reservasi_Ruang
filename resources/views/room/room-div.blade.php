            <div class="col s12 m6 l4">
              <div class="card">
                <div class="card-image waves-effect waves-block waves-light">
                  @if ($room->room_imagepath)
                    <img src="{{asset($room->room_imagepath)}}">
                  @endif
                </div>
                <div class="card-content">
                  <span class="card-title activator gray-text text-darken-4">
                    {{ $room->room_code }} {{ $room->room_name }} <i class="material-icons right">more_vert</i>
                  </span>
                  <p>
                    <a href="{{url('/agenda/'.$room->room_code)}}">Cek Status Ruangan</a>
                  </p>
                  <p>
                    <a href="{{url('/room/detail/'.$room->room_code)}}">Detail Ruangan</a>
                  </p>
                  @if (Auth::check() && Auth::user()->hasRole('manage_room'))
                    <p>
                      <a href="{{url('/room/edit/'.$room->id)}}">Edit Ruangan</a>
                    </p>
                  @endif
                </div>
                <div class="card-reveal">
                  <span class="card-title activator gray-text text-darken-4">
                    {{ $room->room_code }} {{ $room->room_name }}<i class="material-icons right">close</i>
                  </span>
                  <p>
                    @if ($room->hasTechnicians())
                      Teknisi: <br>
                      @foreach ($room->technicians as $tech)
                        {{$tech->user_name}} <br>
                      @endforeach
                    @else
                      Ruangan ini belum memiliki teknisi
                    @endif
                  </p>
                </div>
              </div>
            </div>