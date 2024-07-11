<x-filament-panels::page>
  <div class="flex items-center justify-center ">
    <div class="max-w-96  mx-auto" style="width: 600px">
      <form action="{{ url('/admin/laporan-aktivitas/export') }}" method="post">
        @CSRF
        <x-filament::section class="">
          <x-slot name="heading">
            Form Laporan Aktivitas
          </x-slot>

          <x-filament::fieldset>
            <x-slot name="label">
              Pilih Bulan
            </x-slot>
            <x-filament::input.wrapper>
              <x-filament::input.select wire:model="bulan" name="bulan">
                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
              </x-filament::input.select>
            </x-filament::input.wrapper>

            {{-- Form fields --}}
          </x-filament::fieldset>
          <x-filament::fieldset>
            <x-slot name="label">
              Pilih Tahun
            </x-slot>
            <x-filament::input.wrapper>
              <x-filament::input.select wire:model="tahun" name="tahun">
                @foreach ((function () {
        $year = date('Y');
        $years = [];
        for ($i = 0; $i < 3; $i++) {
            $years[] = $year - $i;
        }

        return $years;
    })() as $year)
                  <option value="{{ $year }}">{{ $year }}</option>
                @endforeach
              </x-filament::input.select>
            </x-filament::input.wrapper>

            {{-- Form fields --}}
          </x-filament::fieldset>
          <x-filament::fieldset>
            <x-slot name="label">
              Pilih Pegawai
            </x-slot>
            <x-filament::input.wrapper>
              <x-filament::input.select wire:model="employee_id" name="employee_id">
                @foreach ($employee as $d)
                  <option value="{{ $d->id }}">{{ $d->fullname }}</option>
                @endforeach
              </x-filament::input.select>
            </x-filament::input.wrapper>
            <div class="text-center mt-2">
              <x-filament::button icon="heroicon-o-printer" type="submit">
                Export
              </x-filament::button>
            </div>
            {{-- Form fields --}}
          </x-filament::fieldset>
        </x-filament::section>
      </form>
    </div>
  </div>
</x-filament-panels::page>
