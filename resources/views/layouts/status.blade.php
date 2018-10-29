  @if(session('message'))
    <div class="card-panel blue darken-4">
      <a style="color: white"><i class="material-icons left">info</i> {{ session('message') }}</a>
    </div>
  @endif
