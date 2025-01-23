<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Selamat Datang -->
            <div class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white shadow-md rounded-lg mb-8 p-6">
                <div class="flex items-center space-x-4">
                    <div class="bg-white text-blue-500 rounded-full p-3">
                        <i class="fas fa-check-circle fa-2x"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold">Selamat Datang!</h3>
                        <p class="mt-1 text-sm">
                            {{ __("You're logged in!") }}
                        </p>
                    </div>
                </div>
            </div>
<br>
            <!-- Statistik -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                <!-- Jumlah Kelas -->
                <div class="bg-blue-500 text-white shadow-sm sm:rounded-lg p-4 flex items-center space-x-4">
                    <i class="fas fa-school fa-2x"></i>
                    <div>
                        <h3 class="text-md font-semibold">Jumlah Kelas</h3>
                        <p class="text-2xl font-bold mt-2">{{ $jumlahKelas }}</p>
                    </div>
                </div>

                <!-- Jumlah Siswa -->
                <div class="bg-green-500 text-white shadow-sm sm:rounded-lg p-4 flex items-center space-x-4">
                    <i class="fas fa-user-graduate fa-2x"></i>
                    <div>
                        <h3 class="text-md font-semibold">Jumlah Siswa</h3>
                        <p class="text-2xl font-bold mt-2">{{ $jumlahSiswa }}</p>
                    </div>
                </div>

                <!-- Jumlah Guru -->
                <div class="bg-yellow-500 text-white shadow-sm sm:rounded-lg p-4 flex items-center space-x-4">
                    <i class="fas fa-chalkboard-teacher fa-2x"></i>
                    <div>
                        <h3 class="text-md font-semibold">Jumlah Guru</h3>
                        <p class="text-2xl font-bold mt-2">{{ $jumlahGuru }}</p>
                    </div>
                </div>

                <!-- Jumlah Pelajaran -->
                <div class="bg-red-500 text-white shadow-sm sm:rounded-lg p-4 flex items-center space-x-4">
                    <i class="fas fa-book fa-2x"></i>
                    <div>
                        <h3 class="text-md font-semibold">Jumlah Pelajaran</h3>
                        <p class="text-2xl font-bold mt-2">{{ $jumlahPelajaran }}</p>
                    </div>
                </div>

                <!-- Jumlah Wali Kelas -->
                <div class="bg-indigo-500 text-white shadow-sm sm:rounded-lg p-4 flex items-center space-x-4">
                    <i class="fas fa-users fa-2x"></i>
                    <div>
                        <h3 class="text-md font-semibold">Jumlah Wali Kelas</h3>
                        <p class="text-2xl font-bold mt-2">{{ $jumlahWaliKelas }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
