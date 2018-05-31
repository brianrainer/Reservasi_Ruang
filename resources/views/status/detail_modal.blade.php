  <div id="{{ $modal_id }}" class="modal">
    <div class="modal-content">
      <h4>{{ $title }}</h4>
      <p>{{ $content }}</p>
      <div class="modal-footer">
        <form method="POST" action="{{ $routing }}">
          {{csrf_field()}}
          <input type="hidden" name="booking_id" value="">
          <input type="hidden" name="detail_id" value="">
          <a class="btn waves-effect waves-light grey modal-close">
            Kembali
          </a>
          <button class="btn waves-effect waves-light {{ $button_class }}" type="submit">
            {{ $button }}
          </button>
        </form>
      </div>
    </div>
  </div>