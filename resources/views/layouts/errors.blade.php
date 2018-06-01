
  @if ($errors->any())
    <div class="card-panel red">
      <ul>
        @foreach ($errors->all() as $error)
          <li>
            {{ $error }}
          </li>
        @endforeach
      </ul>
    </div>
  @endif

  @if (!empty($error))
    <div class="card-panel red">
      {{ $error }}
    </div>
  @endif