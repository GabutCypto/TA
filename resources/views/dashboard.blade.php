<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                    <div class="py-4">
                        <h2 class="text-xl font-semibold">Selamat datang, {{ $user->name }}</h2>
                        @role('buyer') 
                            <div class="mt-4">
                                <h3 class="text-lg">Saldo Anda: Rp {{ number_format($saldo, 0, ',', '.') }}</h3>
                            </div>
                        @endrole
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
