<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            {{ __('Daftar Transaksi Saldo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-10 shadow-lg rounded-lg border border-gray-200">

                <!-- Success Message -->
                @if(session('success'))
                    <div class="mb-6 text-sm bg-green-500 text-white py-2 px-4 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Error Message -->
                @if(session('error'))
                    <div class="mb-6 text-sm bg-red-500 text-white py-2 px-4 rounded-lg">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Table -->
                <table class="w-full border-collapse border border-gray-300 text-left text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2">#</th>
                            <th class="border border-gray-300 px-4 py-2">Nama Pengguna</th>
                            <th class="border border-gray-300 px-4 py-2">Santri</th>
                            <th class="border border-gray-300 px-4 py-2">Jumlah</th>
                            <th class="border border-gray-300 px-4 py-2">Keterangan</th>
                            <th class="border border-gray-300 px-4 py-2">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transaksiSaldo as $transaksi)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $transaksi->user->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <!-- Assuming there's a relationship with the 'Santri' model -->
                                    {{ $transaksi->santri ? $transaksi->santri->nama : 'Tidak ada santri' }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2">Rp {{ number_format($transaksi->jumlah, 0, ',', '.') }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $transaksi->keterangan }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $transaksi->created_at->format('d-m-Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="border border-gray-300 px-4 py-2 text-center">Tidak ada transaksi</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Button -->
                @role('owner')
                <div class="mt-6">
                    <a href="{{ route('transaksisaldo.create') }}" class="py-3 px-6 rounded-lg text-white bg-indigo-700 hover:bg-indigo-800 transition duration-300 ease-in-out">
                        {{ __('Tambah Transaksi') }}
                    </a>
                </div>
                @endrole
            </div>
        </div>
    </div>
</x-app-layout>
