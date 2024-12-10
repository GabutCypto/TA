<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Sumbangan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow-lg rounded-lg">

                @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="py-3 w-full rounded-3xl bg-red-500 text-white mb-4">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
                
                <form method="POST" action="{{ route('admin.sumbangan.store') }}" enctype="multipart/form-data">
                    @csrf
            
                    <!-- Nama -->
                    <div class="mb-6">
                        <x-input-label for="nama" :value="__('Nama')" />
                        <x-text-input id="nama" class="block mt-1 w-full border border-gray-300 rounded-lg p-3 focus:ring-indigo-500 focus:border-indigo-500" type="text" name="nama" :value="old('nama')" required autofocus autocomplete="nama" />
                        <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                    </div>
            
                    <!-- Deskripsi -->
                    <div class="mb-6">
                        <x-input-label for="deskripsi" :value="__('Deskripsi')" />
                        <x-text-input id="deskripsi" class="block mt-1 w-full border border-gray-300 rounded-lg p-3 focus:ring-indigo-500 focus:border-indigo-500" type="text" name="deskripsi" :value="old('deskripsi')" required autocomplete="deskripsi" />
                        <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                    </div>

                    <!-- Jumlah -->
                    <div class="mb-6">
                        <x-input-label for="jumlah" :value="__('Jumlah')" />
                        <x-text-input id="jumlah" class="block mt-1 w-full border border-gray-300 rounded-lg p-3 focus:ring-indigo-500 focus:border-indigo-500" type="number" name="jumlah" :value="old('jumlah')" required autocomplete="jumlah" />
                        <x-input-error :messages="$errors->get('jumlah')" class="mt-2" />
                    </div>
                    <!-- Buttons -->
                    <div class="flex items-center justify-between mt-4">
                        <!-- Add Button -->
                        <x-primary-button class="py-3 px-6 rounded-full text-white bg-indigo-700 hover:bg-indigo-800 transition duration-300 ease-in-out shadow-md hover:shadow-lg">
                            {{ __('Tambahkan Sumbangan Baru') }}
                        </x-primary-button>

                        <!-- Cancel Button -->
                        <a href="{{ route('admin.sumbangan.index') }}" class="py-3 px-6 rounded-full text-gray-700 bg-gray-200 hover:bg-gray-300 transition duration-300 ease-in-out shadow-md hover:shadow-lg">
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
