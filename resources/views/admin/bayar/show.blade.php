<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-900 leading-tight">
            {{ __('Detail Pembayaran Sumbangan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow border border-gray-200">

                <!-- Daftar Item Sumbangan -->
                <div class="mb-6">
                    <h3 class="text-xl font-semibold text-gray-800">{{ __('Sumbangan yang dibayar') }}</h3>
                    <div class="flex justify-between mt-4">
                        <span class="text-gray-700">{{ $bayar_sumbangan->sumbangan->nama }}</span>
                        <span class="text-gray-600">Rp {{ number_format($bayar_sumbangan->sumbangan->jumlah, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Informasi Penerima -->
                <div class="mb-6">
                    <h3 class="text-xl font-semibold text-gray-800">{{ __('Pembayaran sumbangan untuk') }}</h3>
                    <div class="mt-4">
                        <div class="flex justify-between mb-4">
                            <span class="text-gray-600">Nama Santri</span>
                            <span class="text-gray-700">{{ $bayar_sumbangan->santri->nama }}</span>
                        </div>
                        <div class="flex justify-between mb-4">
                            <span class="text-gray-600">Tanggal Pembayaran</span>
                            <span class="text-gray-700">{{ $bayar_sumbangan->created_at->format('d-m-Y H:i') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Status Pembayaran</span>
                            <span class="font-semibold text-gray-800">
                                <span class="py-1 px-3 rounded-full text-sm {{ $bayar_sumbangan->dibayar ? 'bg-green-500 text-white' : 'bg-yellow-500 text-white' }}">
                                    {{ $bayar_sumbangan->dibayar ? 'Lunas' : 'Belum Lunas' }}
                                </span>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Bukti Pembayaran -->
                <div class="mb-6">
                    <h3 class="text-xl font-semibold text-gray-800">{{ __('Bukti Pembayaran') }}</h3>
                    @if($bayar_sumbangan->bukti)
                        <div class="mt-4">
                            <img src="{{ Storage::url($bayar_sumbangan->bukti) }}" alt="Bukti Pembayaran" class="w-full max-w-xs mx-auto h-auto rounded-md">
                        </div>
                    @else
                        <p class="text-gray-600 mt-4">Belum ada bukti pembayaran.</p>
                    @endif
                </div>

                <!-- Tindakan -->
                <div class="flex justify-end">
                    @role('owner')
                        @if(!$bayar_sumbangan->dibayar)
                            <form method="POST" action="{{ route('bayar_sumbangan.update', $bayar_sumbangan) }}">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="py-2 px-4 rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 transition duration-200">
                                    Setujui Pembayaran
                                </button>
                            </form>
                        @else
                            <a href="{{ route('bayar_sumbangan.index') }}" 
                                class="py-2 px-4 rounded-lg text-white bg-blue-500 hover:bg-blue-600 transition duration-200">
                                Kembali
                            </a>
                        @endif
                    @endrole
                
                    @role('buyer') <!-- Hanya muncul untuk role 'buyer' -->
                        @if(!$bayar_sumbangan->dibayar) <!-- Hanya jika pembayaran belum terupdate -->
                            <a href="https://wa.me/?text=Halo, saya ingin menghubungi Anda mengenai pembayaran sumbangan."
                               class="py-2 px-4 rounded-lg text-white bg-green-500 hover:bg-green-600 transition duration-200">
                                Hubungi via WhatsApp
                            </a>
                        @endif
                    @endrole
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
