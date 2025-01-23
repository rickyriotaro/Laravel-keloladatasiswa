<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add KKM') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <form action="{{ route('kkm.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
            @csrf

            <div class="mb-4">
                <label for="kelas_id" class="block text-sm font-medium text-gray-700">Class</label>
                <select name="kelas_id" id="kelas_id" class="w-full border-gray-300 rounded-md">
                    <option value="">Select Class</option>
                    @foreach ($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="kkm_value" class="block text-sm font-medium text-gray-700">KKM</label>
                <input type="number" name="kkm_value" id="kkm_value" class="w-full border-gray-300 rounded-md" min="0" max="100" required>
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Save
            </button>
        </form>
    </div>
</x-app-layout>
