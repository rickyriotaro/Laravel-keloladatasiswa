<x-app-layout>


    <div class="flex justify-center items-center h-screen bg-gray-100">
        <div class="text-center bg-white p-10 rounded-lg shadow-lg">
            <h1 class="text-6xl font-bold text-red-500 mb-6">403</h1>
            <p class="text-xl text-gray-700 mb-4">Oops! Anda tidak memiliki akses untuk melakukan tindakan ini.</p>
            <p class="text-sm text-gray-500 mb-6">Silakan hubungi administrator jika Anda yakin ini adalah kesalahan.</p>
            <a href="{{ route('dashboard') }}"
               class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-800 transition duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-8V5a1 1 0 112 0v5h3a1 1 0 110 2h-4a1 1 0 01-1-1z" clip-rule="evenodd" />
                </svg>
                Kembali ke Dashboard
            </a>
        </div>
    </div>
</x-app-layout>
