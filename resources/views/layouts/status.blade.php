  @if(session('message'))
    <div class="card-panel teal">
      <a style="color: white"><i class="material-icons left">info</i> {{ session('message') }}</a>
    </div>
  @endif
