 <table class="min-w-full divide-y divide-gray-200">
   <thead class="bg-gray-50">
     <tr>
       <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
         No
       </th>
       <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
         #
       </th>
       <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
         Nama
       </th>
       <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
         Presensi Masuk
       </th>
       <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
         Presensi Pulang
       </th>
     </tr>
   </thead>
   <tbody class="bg-white divide-y divide-gray-200">
     @foreach ($presence->filter(fn($d) => $d->employee_level_id < 8) as $i => $d)
       <tr>
         <td class="px-6 py-4 whitespace-nowrap">
           <div class="text-sm text-gray-900">{{ $i + 1 }}</div>
         </td>
         <td class="px-6 py-4 whitespace-nowrap">
           <x-filament::avatar src="{{ $d->photos }}" alt="{{ $d->fullname }}" />
         </td>
         <td class="px-6 py-4 whitespace-nowrap">
           <div class="text-sm text-gray-900">{{ $d->fullname }}</div>
         </td>
         <td class="px-6 py-4 whitespace-nowrap">
           @if (!$d->masuk)
             <x-filament::badge color="danger">
               Tidak Absen
             </x-filament::badge>
           @else
             <x-filament::badge>
               {{ $d->masuk }}
             </x-filament::badge>
           @endif
         </td>
         <td class="px-6 py-4 whitespace-nowrap">
           @if (!$d->pulang)
             <x-filament::badge color="warning">
               Belum Absen
             </x-filament::badge>
           @else
             <x-filament::badge color="info">
               {{ $d->pulang }}
             </x-filament::badge>
           @endif
         </td>
       </tr>
     @endforeach
   </tbody>
   <thead class="bg-gray-50">
     <tr>
       <th colspan="5" scope="col"
         class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
         Presensi Security
       </th>
     </tr>
     <tr>
       <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
         No
       </th>
       <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
         #
       </th>
       <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
         Nama
       </th>
       <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
         Presensi Masuk
       </th>
       <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
         Presensi Pulang
       </th>
     </tr>
   </thead>
   @foreach ($presence->filter(fn($d) => $d->employee_level_id > 7) as $i => $d)
     <tr>
       <td class="px-6 py-4 whitespace-nowrap">
         <div class="text-sm text-gray-900">{{ $i + 1 }}</div>
       </td>
       <td class="px-6 py-4 whitespace-nowrap">
         <x-filament::avatar src="{{ $d->photos }}" alt="{{ $d->fullname }}" />
       </td>
       <td class="px-6 py-4 whitespace-nowrap">
         <div class="text-sm text-gray-900">{{ $d->fullname }}</div>
       </td>
       <td class="px-6 py-4 whitespace-nowrap">
         @if (!$d->masuk)
           <x-filament::badge color="danger">
             Tidak Absen
           </x-filament::badge>
         @else
           <x-filament::badge>
             {{ $d->masuk }}
           </x-filament::badge>
         @endif
       </td>
       <td class="px-6 py-4 whitespace-nowrap">
         @if (!$d->pulang)
           <x-filament::badge color="warning">
             Belum Absen
           </x-filament::badge>
         @else
           <x-filament::badge color="info">
             {{ $d->pulang }}
           </x-filament::badge>
         @endif
       </td>
     </tr>
   @endforeach
 </table>
