<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            {{ __('Santri List') }}
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
                            <th class="py-3 px-6 border-b text-center">{{ __('Foto') }}</th>
                            <th class="py-3 px-6 border-b text-left">{{ __('Nama') }}</th>
                            <th class="py-3 px-6 border-b text-left">{{ __('Orang Tua') }}</th>
                            <th class="py-3 px-6 border-b text-left">{{ __('Alamat') }}</th>
                            <th class="py-3 px-6 border-b text-center">{{ __('Tindakan') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($santri as $item)
                            <tr class="hover:bg-gray-50 transition duration-200">
                                <!-- Foto Column -->
                                <td class="py-4 px-6 border-b text-center">
                                    @if($item->foto)
                                        <img src="{{ Storage::url($item->foto) }}" alt="Foto" class="w-16 h-16 object-cover rounded-full mx-auto shadow-md border-2 border-gray-300">
                                    @else
                                        <span class="text-sm text-gray-500">{{ __('No Photo') }}</span>
                                    @endif
                                </td>
                
                                <!-- Nama Column -->
                                <td class="py-4 px-6 border-b text-gray-800">{{ $item->nama }}</td>
                
                                <!-- Ortu Column -->
                                <td class="py-4 px-6 border-b text-gray-800">{{ $item->ortu }}</td>
                
                                <!-- Alamat Column -->
                                <td class="py-4 px-6 border-b text-gray-800">{{ $item->alamat }}</td>
                
                                <!-- Actions Column -->
                                <td class="py-4 px-6 border-b text-center">
                                    <div class="flex justify-center gap-4">
                                        <!-- Edit Button -->
                                        <a href="{{ route('admin.santri.edit', $item) }}" 
                                           class="py-2 px-4 rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 transition duration-300 ease-in-out shadow-md">
                                            Edit
                                        </a>
                
                                        <!-- Delete Button -->
                                        <form method="POST" action="{{ route('admin.santri.destroy', $item) }}" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="py-2 px-4 rounded-lg text-white bg-red-600 hover:bg-red-700 transition duration-300 ease-in-out shadow-md">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Add New Santri Button -->
                <div class="mt-6">
                    <a href="{{ route('admin.santri.create') }}" class="py-3 px-6 rounded-lg text-white bg-indigo-700 hover:bg-indigo-800 transition duration-300 ease-in-out">
                        {{ __('Tambahkan Santri Baru') }}
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
