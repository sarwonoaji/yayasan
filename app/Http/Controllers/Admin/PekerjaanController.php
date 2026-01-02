<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;

class PekerjaanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pekerjaan::query();

        // Handle search
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where('nama_pekerjaan', 'like', '%' . $search . '%');
        }

        $pekerjaans = $query->latest()->paginate(10);

        // If AJAX request, return only the table content
        if ($request->ajax()) {
            return view('admin.pekerjaan.partials.table', compact('pekerjaans'))->render();
        }

        return view('admin.pekerjaan.index', compact('pekerjaans'));
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
