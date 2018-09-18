  @if ($errors->any())
    <div class="card horizontal red">
      <div class="card-stacked">
        @foreach ($errors->all() as $error)
          <div class="card-content">
            <a style="color: white"><i class="material-icons left">warning</i> {{ $error }}</a>
          </div>
        @endforeach
      </div>
    </div>
  @endif
