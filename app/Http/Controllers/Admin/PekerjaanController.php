<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;

class PekerjaanController extends Controller
{
    public function index()
    {
        return view('admin.pekerjaan.index', [
            'pekerjaans' => Pekerjaan::latest()->get()
        ]);
    }

    public function create()
    {
        return view('admin.pekerjaan.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_pekerjaan'     => 'required|string|max:255',
            
        ]);



        Pekerjaan::create($data);

        return redirect()
            ->route('admin.pekerjaan.index')
            ->with('success', 'Pekerjaan berhasil dibuat');
    }

    public function edit(Pekerjaan $pekerjaan)
    {
        return view('admin.pekerjaan.edit', compact('pekerjaan'));
    }

    public function update(Request $request, Pekerjaan $pekerjaan)
    {
        $data = $request->validate([
            'nama_pekerjaan'     => 'required|string|max:255',
        ]);


        $pekerjaan->update($data);

        return redirect()
            ->route('admin.pekerjaan.index')
            ->with('success', 'Pekerjaan berhasil diperbarui');
    }

    public function destroy(Pekerjaan $pekerjaan)
    {
        $pekerjaan->delete();

        return back()->with('success', 'Pekerjaan berhasil dihapus');
    }
}
