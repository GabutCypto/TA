<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            {{ __('Santri Baru') }}
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
                <form method="POST" action="{{ route('admin.santri.store') }}" enctype="multipart/form-data">
                    @csrf
            
                    <!-- Nama (Name) -->
                    <div class="mb-6">
                        <x-input-label for="nama" :value="__('Santri Nama')" />
                        <x-text-input id="nama" class="block mt-1 w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" type="text" name="nama" :value="old('nama')" required autocomplete="name" />
                        <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                    </div>

                    <!-- Parent's Name (Ortu) -->
                    <div class="mb-6">
                        <x-input-label for="ortu" :value="__('Orang Tua')" />
                        <x-text-input id="ortu" class="block mt-1 w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" type="text" name="ortu" :value="old('ortu')" required />
                        <x-input-error :messages="$errors->get('ortu')" class="mt-2" />
                    </div>

                    <!-- Address (Alamat) -->
                    <div class="mb-6">
                        <x-input-label for="alamat" :value="__('Alamat')" />
                        <x-text-input id="alamat" class="block mt-1 w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" type="text" name="alamat" :value="old('alamat')" required />
                        <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                    </div>

                    <!-- Photo (Foto) -->
                    <div class="mb-6">
                        <x-input-label for="foto" :value="__('Foto')" />
                        <x-text-input id="foto" class="block mt-1 w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" type="file" name="foto" />
                        <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                    </div>
            
                    <!-- Buttons -->
                    <div class="flex items-center justify-between">
                        <x-primary-button class="py-3 px-6 rounded-lg text-white bg-indigo-700 hover:bg-indigo-800 transition duration-300 ease-in-out">
                            {{ __('Tambah Santri Baru') }}
                        </x-primary-button>
                        <a href="{{ route('admin.santri.index') }}" class="py-3 px-6 rounded-lg text-gray-700 bg-gray-200 hover:bg-gray-300 transition duration-300 ease-in-out">
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
