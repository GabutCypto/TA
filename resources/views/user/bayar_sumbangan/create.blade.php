<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            {{ __('Bayar Sumbangan') }}
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
                <form method="POST" action="{{ route('bayar_sumbangan.index') }}" enctype="multipart/form-data">
                    @csrf
            
                    <!-- Santri (Student) -->
                    <div class="mb-6">
                        <x-input-label for="santri_id" :value="__('Santri')" />
                        <select id="santri_id" name="santri_id" class="block mt-1 w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required>
                            <option value="">-- Pilih Santri --</option>
                            @foreach ($santri as $s)
                                <option value="{{ $s->id }}" {{ old('santri_id') == $s->id ? 'selected' : '' }}>{{ $s->nama }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('santri_id')" class="mt-2" />
                    </div>

                    <!-- Sumbangan (Donation) -->
                    <div class="mb-6">
                        <x-input-label for="sumbangan_id" :value="__('Sumbangan')" />
                        <select id="sumbangan_id" name="sumbangan_id" class="block mt-1 w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required>
                            <option value="">-- Pilih Sumbangan --</option>
                            @foreach ($sumbangan as $s)
                                <option value="{{ $s->id }}" {{ old('sumbangan_id') == $s->id ? 'selected' : '' }}>
                                    {{ $s->nama }} ({{ $s->jumlah }})
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('sumbangan_id')" class="mt-2" />
                    </div>

                    <!-- Bukti Pembayaran (Payment Proof) -->
                    <div class="mb-6">
                        <x-input-label for="bukti" :value="__('Bukti Pembayaran')" />
                        <x-text-input id="bukti" class="block mt-1 w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" type="file" name="bukti" required />
                        <x-input-error :messages="$errors->get('bukti')" class="mt-2" />
                    </div>
            
                    <!-- Buttons -->
                    <div class="flex items-center justify-between">
                        <x-primary-button class="py-3 px-6 rounded-lg text-white bg-indigo-700 hover:bg-indigo-800 transition duration-300 ease-in-out">
                            {{ __('Bayar Sumbangan') }}
                        </x-primary-button>
                        <a href="{{ route('bayar_sumbangan.index') }}" class="py-3 px-6 rounded-lg text-gray-700 bg-gray-200 hover:bg-gray-300 transition duration-300 ease-in-out">
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
