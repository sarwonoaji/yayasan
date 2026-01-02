<div class="mt-4 bg-white rounded shadow overflow-x-auto">
    <table class="w-full min-w-[720px]">
        <thead>
            <tr class="text-left bg-slate-700">
                <th class="p-3 text-slate-100">Pekerjaan</th>
                <th class="p-3 text-slate-100 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pekerjaans as $p)
            <tr class="border-b hover:bg-emerald-50">
                <td class="p-3 text-center font-semibold">{{ $p->nama_pekerjaan}}</td>
                <td class="p-3">
                    <div class="flex items-center justify-center gap-2">
                        <a href="{{ route('admin.pekerjaan.edit', $p) }}" class="inline-flex items-center justify-center w-8 h-8 rounded hover:bg-emerald-50 text-emerald-600 border border-transparent hover:border-emerald-100" title="Edit">
                            <span class="material-symbols-outlined text-[18px]">edit</span>
                        </a>

                        <form method="POST" action="{{ route('admin.pekerjaan.destroy', $p) }}" onsubmit="return confirm('Hapus pekerjaan ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded hover:bg-red-50 text-red-600 border border-transparent hover:border-red-100" title="Hapus">
                                <span class="material-symbols-outlined text-[18px]">delete</span>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="2" class="p-6 text-center text-gray-500">Belum ada pekerjaan</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($pekerjaans->hasPages())
    <x-pagination :paginator="$pekerjaans" />
@endif