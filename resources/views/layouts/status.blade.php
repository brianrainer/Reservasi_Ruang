  @if (!empty($status))
    <div class="card-panel teal">
      {{ $status }}
    </div>
  @endif

  @if (session('status'))
    <div class="card-panel teal">
      {{ session('status') }}
    </div>
  @endif
