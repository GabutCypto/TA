<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            {{ __('Tambah Transaksi Saldo') }}
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
                <form method="POST" action="{{ route('transaksisaldo.store') }}">
                    @csrf

                    <!-- User Select -->
                    <div class="mb-6">
                        <x-input-label for="user_id" :value="__('Pengguna')" />
                        <select id="user_id" name="user_id" class="block mt-1 w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required>
                            <option value="">Pilih Pengguna</option>
                            @foreach (\App\Models\User::all() as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                    </div>

                    <!-- Santri Select -->
                    <div class="mb-6">
                        <x-input-label for="santri_id" :value="__('Santri')" />
                        <select id="santri_id" name="santri_id" class="block mt-1 w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required>
                            <option value="">Pilih Santri</option>
                            @foreach (\App\Models\Santri::all() as $santri)
                                <option value="{{ $santri->id }}" {{ old('santri_id') == $santri->id ? 'selected' : '' }}>{{ $santri->nama }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('santri_id')" class="mt-2" />
                    </div>

                    <!-- Jumlah (Amount) -->
                    <div class="mb-6">
                        <x-input-label for="jumlah" :value="__('Jumlah Saldo')" />
                        <x-text-input id="jumlah" class="block mt-1 w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" type="number" name="jumlah" :value="old('jumlah')" required min="1000" />
                        <x-input-error :messages="$errors->get('jumlah')" class="mt-2" />
                    </div>

                    <!-- Keterangan (Description) -->
                    <div class="mb-6">
                        <x-input-label for="keterangan" :value="__('Keterangan')" />
                        <x-text-input id="keterangan" class="block mt-1 w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" type="text" name="keterangan" :value="old('keterangan')" required />
                        <x-input-error :messages="$errors->get('keterangan')" class="mt-2" />
                    </div>

                    <!-- Buttons -->
                    @role('owner')
                    <div class="flex items-center justify-between">
                        <x-primary-button class="py-3 px-6 rounded-lg text-white bg-indigo-700 hover:bg-indigo-800 transition duration-300 ease-in-out">
                            {{ __('Tambah Transaksi') }}
                        </x-primary-button>
                        <a href="{{ route('transaksisaldo.index') }}" class="py-3 px-6 rounded-lg text-gray-700 bg-gray-200 hover:bg-gray-300 transition duration-300 ease-in-out">
                            {{ __('Batal') }}
                        </a>
                    </div>
                    @endrole

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
