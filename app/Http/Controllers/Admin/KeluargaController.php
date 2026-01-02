<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use Barryvdh\DomPDF\Facade\Pdf;

class KeluargaController extends Controller
{
    /**
     * Display a listing of families (Kepala Keluarga).
     */
    public function index()
    {
        $keluargas = Anggota::where('status_kk', 'Kepala Keluarga')
            ->where('is_deleted', false)
            ->with(['pekerjaan'])
            ->paginate(10);

        return view('admin.keluargas.index', compact('keluargas'));
    }

    /**
     * Display the specified family details.
     */
    public function show($id)
    {
        $kepalaKeluarga = Anggota::where('id', $id)
            ->where('status_kk', 'Kepala Keluarga')
            ->where('is_deleted', false)
            ->firstOrFail();

        $anggotaKeluarga = Anggota::where('no_kk', $kepalaKeluarga->no_kk)
            ->where('is_deleted', false)
            ->with(['pekerjaan'])
            ->orderByRaw("CASE
                WHEN status_kk = 'Kepala Keluarga' THEN 1
                WHEN status_kk = 'Istri' THEN 2
                WHEN status_kk = 'Anak' THEN 3
                ELSE 4
            END")
            ->get();

        return view('admin.keluargas.show', compact('kepalaKeluarga', 'anggotaKeluarga'));
    }

    /**
     * Generate PDF for family details.
     */
    public function pdf($id)
    {
        $kepalaKeluarga = Anggota::where('id', $id)
            ->where('status_kk', 'Kepala Keluarga')
            ->where('is_deleted', false)
            ->firstOrFail();

        $anggotaKeluarga = Anggota::where('no_kk', $kepalaKeluarga->no_kk)
            ->where('is_deleted', false)
            ->with(['pekerjaan'])
            ->orderByRaw("CASE
                WHEN status_kk = 'Kepala Keluarga' THEN 1
                WHEN status_kk = 'Istri' THEN 2
                WHEN status_kk = 'Anak' THEN 3
                ELSE 4
            END")
            ->get();

        $pdf = Pdf::loadView('admin.keluargas.pdf', compact('kepalaKeluarga', 'anggotaKeluarga'));

        $filename = 'Keluarga_' . $kepalaKeluarga->nama_lengkap . '_' . date('Y-m-d') . '.pdf';

        return $pdf->download($filename);
    }
}