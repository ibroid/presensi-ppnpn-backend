<div>
  <x-filament::button outlined size="sm" color="success"
    href="https://www.google.com/maps?q={{ $getRecord()->daily_present[0]->location ?? null }}" tag="a"
    target="_blank">
    Lokasi Masuk
  </x-filament::button>
  <x-filament::button outlined size="sm" color="warning"
    href="https://www.google.com/maps?q={{ $getRecord()->daily_present[1]->location ?? null }}" tag="a"
    target="_blank">
    Lokasi Pulang
  </x-filament::button>
</div>
