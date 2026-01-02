<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Anggota::where('is_deleted', false)
            ->with('pekerjaan');

        // Handle search
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nik', 'like', '%' . $search . '%')
                  ->orWhere('nama_lengkap', 'like', '%' . $search . '%')
                  ->orWhere('tempat_lahir', 'like', '%' . $search . '%')
                  ->orWhere('status_kk', 'like', '%' . $search . '%')
                  ->orWhere('no_telp', 'like', '%' . $search . '%')
                  ->orWhereHas('pekerjaan', function($pq) use ($search) {
                      $pq->where('nama_pekerjaan', 'like', '%' . $search . '%');
                  });
            });
        }

        $anggotas = $query->paginate(10);

        // If AJAX request, return only the table content
        if ($request->ajax()) {
            return view('admin.anggotas.partials.table', compact('anggotas'))->render();
        }

        return view('admin.anggotas.index', compact('anggotas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $pekerjaans = Pekerjaan::all();
        $existing_no_kk = Anggota::where('status_kk', 'Kepala Keluarga')
            ->whereNotNull('no_kk')
            ->where('no_kk', '!=', '')
            ->select('no_kk', 'nama_lengkap')
            ->get();

        return view('admin.anggotas.create', compact('pekerjaans', 'existing_no_kk'));
     
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|string|max:16|unique:anggotas,nik',
            'no_kk' => 'required_if:status_kk,Kepala Keluarga,Anggota Keluarga|string|max:16',
            'status_kk' => 'required|string',
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P,Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'golongan_darah' => 'nullable|string|max:5',
            'status_perkawinan' => 'nullable|string|max:255',
            'pekerjaan_id' => 'nullable|exists:pekerjaans,id',
            'desa' => 'nullable|string|max:255',
            'rt' => 'nullable|string|max:5',
            'rw' => 'nullable|string|max:5',
            'kelurahan' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'kabupaten' => 'nullable|string|max:255',
            'provinsi' => 'nullable|string|max:255',
            'tanggal_masuk' => 'nullable|date',
            'no_telp' => 'nullable|string|max:20',
            'foto' => 'nullable|image|max:2048',
            'maps' => 'nullable|string',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('anggotas', 'public');
        }

        Anggota::create($validated);

        return redirect()->route('admin.anggotas.index')
            ->with('success', 'Anggota berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Anggota $anggota)
    {
        return view('admin.anggotas.show', compact('anggota'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Anggota $anggota)
    {
        $pekerjaans = Pekerjaan::all();
        $existing_no_kk = Anggota::where('status_kk', 'Kepala Keluarga')
            ->whereNotNull('no_kk')
            ->where('no_kk', '!=', '')
            ->select('no_kk', 'nama_lengkap')
            ->get();

        return view('admin.anggotas.edit', compact('anggota', 'pekerjaans', 'existing_no_kk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Anggota $anggota)
    {
        $validated = $request->validate([
            'nik' => 'required|string|max:16|unique:anggotas,nik,' . $anggota->id,
            'no_kk' => 'required_if:status_kk,Kepala Keluarga,Anggota Keluarga|string|max:16',
            'status_kk' => 'required|string',
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P,Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'golongan_darah' => 'nullable|string|max:5',
            'status_perkawinan' => 'nullable|string|max:255',
            'pekerjaan_id' => 'nullable|exists:pekerjaans,id',
            'desa' => 'nullable|string|max:255',
            'rt' => 'nullable|string|max:5',
            'rw' => 'nullable|string|max:5',
            'kelurahan' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'kabupaten' => 'nullable|string|max:255',
            'provinsi' => 'nullable|string|max:255',
            'tanggal_masuk' => 'nullable|date',
            'no_telp' => 'nullable|string|max:20',
            'foto' => 'nullable|image|max:2048',
            'latitude' => 'required',
            'longitude' => 'required',
            'maps' => 'nullable|string',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('anggotas', 'public');
        }

        $anggota->update($validated);

        return redirect()->route('admin.anggotas.index')
            ->with('success', 'Anggota berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage (soft delete).
     */
    public function destroy(Anggota $anggota)
    {
        $anggota->update(['is_deleted' => true]);

        return redirect()->route('admin.anggotas.index')
            ->with('success', 'Anggota berhasil dihapus.');
    }

    /**
     * Restore a soft deleted resource.
     */
    public function restore($id)
    {
        $anggota = Anggota::find($id);
        
        if ($anggota) {
            $anggota->update(['is_deleted' => false]);
            return redirect()->route('admin.anggotas.index')
                ->with('success', 'Anggota berhasil dipulihkan.');
        }

        return redirect()->route('admin.anggotas.index')
            ->with('error', 'Anggota tidak ditemukan.');
    }

//   
public function maps(Request $request)
{
    // dropdown
    $provinsis   = Anggota::whereNotNull('provinsi')->distinct()->pluck('provinsi');
    $kabupatens = Anggota::whereNotNull('kabupaten')->distinct()->pluck('kabupaten');
    $kecamatans = Anggota::whereNotNull('kecamatan')->distinct()->pluck('kecamatan');

    // default kosong
    $anggotas = collect();

    // minimal salah satu filter terisi
    if ($request->filled(['provinsi']) || $request->filled(['kabupaten']) || $request->filled(['kecamatan'])) {

        $anggotas = Anggota::query()
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->when($request->provinsi, function ($q) use ($request) {
                $q->where('provinsi', $request->provinsi);
            })
            ->when($request->kabupaten, function ($q) use ($request) {
                $q->where('kabupaten', $request->kabupaten);
            })
            ->when($request->kecamatan, function ($q) use ($request) {
                $q->where('kecamatan', $request->kecamatan);
            })
            ->get();
    }

    return view('admin.anggotas.maps', compact(
        'anggotas',
        'provinsis',
        'kabupatens',
        'kecamatans'
    ));
}


}

