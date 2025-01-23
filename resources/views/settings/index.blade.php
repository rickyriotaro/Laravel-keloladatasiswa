<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="text-2xl font-bold mb-5">Settings</h1>

                @if (session('success'))
                    <div class="bg-green-100 text-green-800 border border-green-300 rounded-lg p-4 mb-5">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('settings.update') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="nama_sekolah" class="block text-sm font-medium text-gray-700">
                            Nama Sekolah
                        </label>
                        <input type="text" id="nama_sekolah" name="nama_sekolah"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                               value="{{ $setting->nama_sekolah ?? '' }}" required>
                    </div> <div>
                        <label for="alamat" class="block text-sm font-medium text-gray-700">
                            Alamat Sekolah
                        </label>
                        <input type="text" id="alamat" name="alamat"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                               value="{{ $setting->alamat ?? '' }}" required>
                    </div>
                    <div>
                        <label for="kepsek_name" class="block text-sm font-medium text-gray-700">
                            Nama Kepala Sekolah
                        </label>
                        <input type="text" id="kepsek_name" name="kepsek_name"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                               value="{{ $setting->kepsek_name ?? '' }}" required>
                    </div>

                    <div>
                        <label for="kepsek_nip" class="block text-sm font-medium text-gray-700">
                            NIP Kepala Sekolah
                        </label>
                        <input type="text" id="kepsek_nip" name="kepsek_nip"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                               value="{{ $setting->kepsek_nip ?? '' }}" required>
                    </div>

                    <div>
                        <label for="academic_year" class="block text-sm font-medium text-gray-700">
                            Tahun Ajaran
                        </label>
                        <input type="text" id="academic_year" name="academic_year"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                               value="{{ $setting->academic_year ?? '' }}" required>
                    </div>
                    <div>
                        <label for="telp" class="block text-sm font-medium text-gray-700">
                            Telepon
                        </label>
                        <input type="number" id="telp" name="telp"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                               value="{{ $setting->telp ?? '' }}" required>
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            Email
                        </label>
                        <input type="email" id="telp" name="email"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                               value="{{ $setting->email ?? '' }}" required>
                    </div>
                    <div class="text-right">
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Save Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
