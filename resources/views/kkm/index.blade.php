<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage KKM') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <a href="{{ route('kkm.create') }}"
           class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Add KKM
        </a>

        <table class="w-full bg-white shadow-md rounded-lg mt-4">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase">Kelas</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase">KKM</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase">Grade Example</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kkms as $kkm)
                    <tr class="border-b">
                        <td class="px-6 py-4">{{ $kkm->kelas->nama_kelas }}</td>
                        <td class="px-6 py-4">{{ $kkm->kkm_value }}</td>
                        <td class="px-6 py-4">
                            <ul>
                                <li>Kurang: &lt;{{ $kkm->kkm_value }}</li>
                                <li>Cukup: {{ $kkm->kkm_value }} - {{ min($kkm->kkm_value + 10, 100) }}</li>
                                <li>Baik: {{ min($kkm->kkm_value + 11, 100) }} - {{ min($kkm->kkm_value + 20, 100) }}</li>
                                <li>Sangat Baik: &gt;{{ min($kkm->kkm_value + 20, 100) }}</li>
                            </ul>
                        </td>

                        <td class="px-6 py-4">
                            <a href="{{ route('kkm.edit', $kkm->id) }}"
                               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Edit
                            </a>
                            <form action="{{ route('kkm.destroy', $kkm->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                        onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
