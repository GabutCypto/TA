<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            {{ __('New Product') }}
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
                <form method="POST" action="{{ route('admin.produk.store') }}" enctype="multipart/form-data">
                    @csrf
            
                    <!-- Name -->
                    <div class="mb-6">
                        <x-input-label for="nama" :value="__('Product Name')" />
                        <x-text-input id="nama" class="block mt-1 w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" type="text" name="nama" :value="old('nama')" required autocomplete="nama" />
                        <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                    </div>

                    <!-- Price -->
                    <div class="mb-6">
                        <x-input-label for="harga" :value="__('Price (IDR)')" />
                        <x-text-input id="harga" class="block mt-1 w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" type="number" name="harga" :value="old('harga')" required autocomplete="harga" />
                        <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                    </div>

                    <!-- Category -->
                    <div class="mb-6">
                        <x-input-label for="kategori_id" :value="__('Category')" />
                        <select name="kategori_id" id="kategori_id" class="block mt-1 w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">{{ __('Choose product category') }}</option>
                            @forelse ($kategori as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                            @empty
                                <option value="">{{ __('No categories available') }}</option>
                            @endforelse
                        </select>
                        <x-input-error :messages="$errors->get('kategori')" class="mt-2" />
                    </div>

                    <!-- About -->
                    <div class="mb-6">
                        <x-input-label for="tentang" :value="__('About Product')" />
                        <textarea name="tentang" id="tentang" rows="4" class="block mt-1 w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">{{ old('tentang') }}</textarea>
                        <x-input-error :messages="$errors->get('tentang')" class="mt-2" />
                    </div>
            
                    <!-- Photo -->
                    <div class="mb-6">
                        <x-input-label for="foto" :value="__('Product Photo')" />
                        <x-text-input id="foto" class="block mt-1 w-full border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" type="file" name="foto" />
                        <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                    </div>
            
                    <!-- Buttons -->
                    <div class="flex items-center justify-between">
                        <x-primary-button class="py-3 px-6 rounded-lg text-white bg-indigo-700 hover:bg-indigo-800 transition duration-300 ease-in-out">
                            {{ __('Add New Product') }}
                        </x-primary-button>
                        <a href="{{ route('admin.produk.index') }}" class="py-3 px-6 rounded-lg text-gray-700 bg-gray-200 hover:bg-gray-300 transition duration-300 ease-in-out">
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>