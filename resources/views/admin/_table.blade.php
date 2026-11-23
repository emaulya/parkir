@php
    $kolom = $rows->isNotEmpty() ? array_keys((array) $rows->first()) : [];
@endphp

<div class="mb-6">
    <h1 class="text-2xl font-bold">{{ $judul }}</h1>
    <p class="text-sm text-slate-500">Total {{ $rows->count() }} data</p>
</div>

<div class="overflow-x-auto rounded-xl bg-white shadow">
    <table class="min-w-full text-sm">
        <thead class="bg-slate-100 text-left text-xs uppercase text-slate-500">
            <tr>
                <th class="px-4 py-3">No</th>
                @foreach ($kolom as $k)
                    <th class="px-4 py-3">{{ str_replace('_', ' ', $k) }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse ($rows as $i => $row)
                <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">{{ $i + 1 }}</td>
                    @foreach ($kolom as $k)
                        <td class="px-4 py-3">{{ $row->$k ?? '-' }}</td>
                    @endforeach
                </tr>
            @empty
                <tr>
                    <td class="px-4 py-6 text-center text-slate-400">Belum ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>