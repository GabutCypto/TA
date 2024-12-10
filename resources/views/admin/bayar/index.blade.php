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

                <!-- Table -->
                <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-lg overflow-hidden">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700 text-sm font-semibold">
                            <th class="py-3 px-6 border-b text-left">{{ __('Nama Santri') }}</th>
                            <th class="py-3 px-6 border-b text-left">{{ __('Total Pembayaran') }}</th>
                            <th class="py-3 px-6 border-b text-left">{{ __('Tanggal Pembayaran') }}</th>
                            <th class="py-3 px-6 border-b text-center">{{ __('Status') }}</th>
                            <th class="py-3 px-6 border-b text-center">{{ __('Tindakan') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bayar_sumbangan as $transaction)
                            <tr class="hover:bg-gray-50 transition duration-200">
                                <!-- Nama Santri Column -->
                                <td class="py-4 px-6 border-b text-gray-800">{{ $transaction->santri->nama }}</td>

                                <!-- Total Pembayaran Column -->
                                <td class="py-4 px-6 border-b text-gray-800">Rp {{ $transaction->sumbangan->jumlah }}</td>

                                <!-- Tanggal Pembayaran Column -->
                                <td class="py-4 px-6 border-b text-gray-800">{{ $transaction->created_at->format('d-m-Y H:i:s') }}</td>

                                <!-- Status Column -->
                                <td class="py-4 px-6 border-b text-center">
                                    @if($transaction->dibayar)
                                        <span class="py-2 px-5 rounded-full text-white bg-green-500 text-sm font-semibold">
                                            {{ __('SUKSES') }}
                                        </span>
                                    @else
                                        <span class="py-2 px-5 rounded-full text-white bg-orange-500 text-sm font-semibold">
                                            {{ __('Tertunda') }}
                                        </span>
                                    @endif
                                </td>

                                <!-- Actions Column -->
                                <td class="py-4 px-6 border-b text-center">
                                    <div class="flex justify-center gap-4">
                                        <a href="{{ route('bayar_sumbangan.show', $transaction) }}" 
                                           class="py-2 px-4 rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 transition duration-300 ease-in-out shadow-md">
                                            {{ __('Lihat Detail') }}
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
