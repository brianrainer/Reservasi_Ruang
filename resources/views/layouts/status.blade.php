  @if(session('message'))
    <div class="card-panel teal">
      {{ session('message') }}
    </div>
  @endif