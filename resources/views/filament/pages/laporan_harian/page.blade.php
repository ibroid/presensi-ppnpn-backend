<x-filament-panels::page>
  <h4>Generate Laporan</h4>
  <form action="{{ url('/admin/laporan-harian/export') }}" class="grid grid-cols-2 gap-4" method="POST">
    @CSRF
    <div>
      <label for="email" class="block text-sm font-medium text-gray-700">Tanggal Laporan</label>
      <input required type="date" name="tanggal" id="email" autocomplete="email"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>
    <div>
      <x-filament::button type="submit">
        Export
      </x-filament::button>
    </div>
  </form>
  <h4>Tabel Presensi Hari Ini</h4>
</x-filament-panels::page>
