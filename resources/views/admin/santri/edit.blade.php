<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Sumbangan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow-lg rounded-lg">

                <!-- Display Error Messages -->
                @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="py-3 w-full rounded-3xl bg-red-500 text-white mb-4">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif

                <!-- Form -->
                <form method="POST" action="{{ route('admin.santri.update', $santri) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Nama -->
                    <div class="mb-6">
                        <x-input-label for="nama" :value="__('Nama')" />
                        <x-text-input id="nama" class="block mt-1 w-full border border-gray-300 rounded-lg p-3 focus:ring-indigo-500 focus:border-indigo-500" type="text" name="nama" value="{{ old('nama', $santri->nama) }}" required autofocus autocomplete="nama" />
                        <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                    </div>

                    <!-- Ortu -->
                    <div class="mb-6">
                        <x-input-label for="ortu" :value="__('Orang Tua')" />
                        <x-text-input id="ortu" class="block mt-1 w-full border border-gray-300 rounded-lg p-3 focus:ring-indigo-500 focus:border-indigo-500" type="text" name="ortu" value="{{ old('ortu', $santri->ortu) }}" required autocomplete="ortu" />
                        <x-input-error :messages="$errors->get('ortu')" class="mt-2" />
                    </div>

                    <!-- Alamat -->
                    <div class="mb-6">
                        <x-input-label for="alamat" :value="__('Alamat')" />
                        <x-text-input id="alamat" class="block mt-1 w-full border border-gray-300 rounded-lg p-3 focus:ring-indigo-500 focus:border-indigo-500" type="text" name="alamat" value="{{ old('alamat', $santri->alamat) }}" required autocomplete="alamat" />
                        <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                    </div>

                    <!-- Foto -->
                    <div class="mb-6">
                        <x-input-label for="foto" :value="__('Foto')" />
                        <input id="foto" class="block mt-1 w-full border border-gray-300 rounded-lg p-3 focus:ring-indigo-500 focus:border-indigo-500" type="file" name="foto" />
                        @if ($santri->foto)
                            <div class="mt-2">
                                <img src="{{ Storage::url($santri->foto) }}" alt="Santri Foto" class="w-32 h-32 rounded-lg object-cover">
                            </div>
                        @endif
                        <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center justify-between mt-4">
                        <!-- Update Button -->
                        <x-primary-button class="py-3 px-6 rounded-full text-white bg-indigo-700 hover:bg-indigo-800 transition duration-300 ease-in-out shadow-md hover:shadow-lg">
                            {{ __('Perbarui Sumbangan') }}
                        </x-primary-button>

                        <!-- Cancel Button -->
                        <a href="{{ route('admin.santri.index') }}" class="py-3 px-6 rounded-full text-gray-700 bg-gray-200 hover:bg-gray-300 transition duration-300 ease-in-out shadow-md hover:shadow-lg">
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
