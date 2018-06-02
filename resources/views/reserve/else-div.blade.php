    <div class="card-panel red">
      Reservasi masih belum dapat dilakukan karena :
      <ul>
        @if (empty($rooms->count()))
          <li> Data Ruangan Belum Ada </li>
        @endif
        @if (empty($routines->count()))
          <li> Data Jeda Berkala Kegiatan Belum Ada </li>
        @endif
        @if (empty($agencies->count()))
          <li> Data Organisasi Belum Ada </li>
        @endif
        @if (empty($categories->count()))
          <li> Data Kategori Kegiatan Belum Ada </li>
        @endif
      </ul>
    </div>
