<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            {{ __('Topup Santri Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-10 shadow-lg rounded-lg border border-gray-200">

                <!-- Error Messages -->
                @if($errors->any())
                    <div class="mb-6">
                        @foreach ($errors->all() as $error)
                            <div class="text-sm bg-red-500 text-white py-2 px-4 rounded-lg mb-2">
                                {{ $error }}
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Form -->
                <form method="POST" action="{{ route('topup.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Santri Select -->
                    <div class="mb-6">
                        <x-input-label for="santri_id" :value="__('Santri')" />
                        <select id="santri_id" name="santri_id" class="block mt-1 w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required>
                            <option value="">Pilih Santri</option>
                            @foreach ($santri as $item)
                                <option value="{{ $item->id }}" {{ old('santri_id') == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('santri_id')" class="mt-2" />
                    </div>

                    <!-- Jumlah (Amount) -->
                    <div class="mb-6">
                        <x-input-label for="jumlah" :value="__('Jumlah Topup')" />
                        <x-text-input id="jumlah" class="block mt-1 w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" type="number" name="jumlah" :value="old('jumlah')" required min="1000" />
                        <x-input-error :messages="$errors->get('jumlah')" class="mt-2" />
                    </div>

                    <!-- Keterangan (Description) -->
                    <div class="mb-6">
                        <x-input-label for="keterangan" :value="__('Keterangan')" />
                        <x-text-input id="keterangan" class="block mt-1 w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" type="text" name="keterangan" :value="old('keterangan')" required />
                        <x-input-error :messages="$errors->get('keterangan')" class="mt-2" />
                    </div>

                    <!-- Bukti (Proof) -->
                    <div class="mb-6">
                        <x-input-label for="bukti" :value="__('Bukti Pembayaran')" />
                        <x-text-input id="bukti" class="block mt-1 w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" type="file" name="bukti" required />
                        <x-input-error :messages="$errors->get('bukti')" class="mt-2" />
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center justify-between">
                        <x-primary-button class="py-3 px-6 rounded-lg text-white bg-indigo-700 hover:bg-indigo-800 transition duration-300 ease-in-out">
                            {{ __('Tambah Topup') }}
                        </x-primary-button>
                        <a href="{{ route('topup.index') }}" class="py-3 px-6 rounded-lg text-gray-700 bg-gray-200 hover:bg-gray-300 transition duration-300 ease-in-out">
                            {{ __('Batal') }}
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
