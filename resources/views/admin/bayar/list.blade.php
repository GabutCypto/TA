<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            {{ __('List Pembayaran Sumbangan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-10 shadow-lg rounded-lg border border-gray-200">

                <!-- Success or Error Messages -->
                @if(session('success'))
                    <div class="mb-6 text-sm bg-green-500 text-white py-2 px-4 rounded-lg mb-2">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 text-sm bg-red-500 text-white py-2 px-4 rounded-lg mb-2">
                        {{ session('error') }}
                    </div>
                @endif

                @role('buyer') <!-- Hanya muncul jika role pengguna adalah 'buyer' -->
                <div class="mb-6 text-right">
                    <a href="{{ route('bayar_sumbangan.create') }}" 
                       class="py-2 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300 ease-in-out shadow-md">
                        {{ __('Tambah Pembayaran Sumbangan') }}
                    </a>
                </div>
                @endrole
                <!-- Table -->
                <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg overflow-hidden">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700 text-sm font-semibold">
                            <th class="py-3 px-6 border-b text-center">{{ __('Nama') }}</th>
                            <th class="py-3 px-6 border-b text-center">{{ __('Jumlah') }}</th>
                            <th class="py-3 px-6 border-b text-left">{{ __('Deskripsi') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sumbangan as $sumbangan)
                            <tr class="hover:bg-gray-50 transition duration-200">
                                <td class="py-4 px-6 border-b text-gray-800 text-center">{{ $sumbangan->nama }}</td>
                                <td class="py-4 px-6 border-b text-gray-800 text-center">Rp {{ $sumbangan->jumlah }}</td>
                                <td class="py-4 px-6 border-b text-gray-800 text-left">{{ $sumbangan->deskripsi }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
