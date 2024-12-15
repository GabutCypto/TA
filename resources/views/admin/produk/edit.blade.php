<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow-xl rounded-lg">

                <!-- Error Messages -->
                @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="py-3 px-6 mb-4 rounded-xl bg-red-500 text-white text-sm">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif

                <!-- Edit Product Form -->
                <form method="POST" action="{{ route('admin.produk.update', $produk) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="mb-6">
                        <x-input-label for="nama" :value="__('Nama')" class="text-lg font-semibold text-gray-700" />
                        <x-text-input 
                            id="nama" 
                            class="block w-full mt-1 border border-gray-300 rounded-lg p-4 text-lg focus:ring-indigo-500 focus:border-indigo-500 transition duration-300"
                            type="text" 
                            name="nama" 
                            value="{{ old('nama', $produk->nama) }}" 
                            required 
                            autofocus 
                            autocomplete="nama" 
                        />
                        <x-input-error :messages="$errors->get('nama')" class="mt-2 text-sm text-red-500" />
                    </div>

                    <!-- Price -->
                    <div class="mb-6">
                        <x-input-label for="harga" :value="__('Price')" class="text-lg font-semibold text-gray-700" />
                        <x-text-input 
                            id="harga" 
                            class="block w-full mt-1 border border-gray-300 rounded-lg p-4 text-lg focus:ring-indigo-500 focus:border-indigo-500 transition duration-300" 
                            type="number" 
                            name="harga" 
                            value="{{ old('harga', $produk->harga) }}" 
                            required 
                            autocomplete="harga" 
                        />
                        <x-input-error :messages="$errors->get('harga')" class="mt-2 text-sm text-red-500" />
                    </div>

                    <!-- Category -->
                    <div class="mb-6">
                        <x-input-label for="kategori" :value="__('Category')" class="text-lg font-semibold text-gray-700" />
                        <select name="kategori_id" id="kategori_id" class="block w-full mt-1 border border-gray-300 rounded-lg p-4 text-lg focus:ring-indigo-500 focus:border-indigo-500 transition duration-300" required>
                            <option value="{{ $produk->kategori->id }}">{{ $produk->kategori->nama }}</option>
                            @forelse ($categories as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                            @empty
                                <option value="" disabled>No categories available</option>
                            @endforelse
                        </select>
                        <x-input-error :messages="$errors->get('kategori_id')" class="mt-2 text-sm text-red-500" />
                    </div>

                    <!-- About -->
                    <div class="mb-6">
                        <x-input-label for="tentang" :value="__('About')" class="text-lg font-semibold text-gray-700" />
                        <textarea 
                            name="tentang" 
                            id="tentang" 
                            class="block w-full mt-1 border border-gray-300 rounded-lg p-4 text-lg focus:ring-indigo-500 focus:border-indigo-500 transition duration-300"
                            rows="6"
                        >{{ old('tentang', $produk->tentang) }}</textarea>
                        <x-input-error :messages="$errors->get('tentang')" class="mt-2 text-sm text-red-500" />
                    </div>

                    <!-- Photo -->
                    <div class="mb-6">
                        <x-input-label for="foto" :value="__('Photo')" class="text-lg font-semibold text-gray-700" />
                        <div class="mb-4">
                            <img src="{{ Storage::url($produk->foto) }}" alt="{{ $produk->foto }}" class="w-32 h-32 object-cover rounded-lg">
                        </div>
                        <x-text-input 
                            id="foto" 
                            class="block w-full mt-1 border border-gray-300 rounded-lg p-4 text-lg focus:ring-indigo-500 focus:border-indigo-500 transition duration-300" 
                            type="file" 
                            name="foto" 
                            autocomplete="foto" 
                        />
                        <x-input-error :messages="$errors->get('foto')" class="mt-2 text-sm text-red-500" />
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-between mt-6">
                        <!-- Save Button -->
                        <x-primary-button class="py-3 px-8 text-lg font-semibold rounded-full text-white bg-indigo-600 hover:bg-indigo-700 transition duration-300 shadow-md hover:shadow-lg">
                            {{ __('Update Product') }}
                        </x-primary-button>

                        <!-- Cancel Button -->
                        <a href="{{ route('admin.produk.index') }}" class="py-3 px-8 text-lg font-semibold rounded-full text-gray-700 bg-gray-200 hover:bg-gray-300 transition duration-300 shadow-md hover:shadow-lg">
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>