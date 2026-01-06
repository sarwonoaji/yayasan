<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\LandingSection;
use App\Models\Page;
use App\Models\Setting;
use App\Models\Anggota;
use App\Models\Pekerjaan;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalNews'        => News::count(),
            'publishedNews'    => News::published()->count(),
            'draftNews'        => News::whereNull('published_at')->count(),
            'landingSections'  => LandingSection::count(),
            'pages'            => Page::count(),
            'setting'          => Setting::first(),
            'totalAnggotas'    => Anggota::count(),
            'activeAnggotas'   => Anggota::where('is_deleted', false)->count(),
            'totalPekerjaan'   => Pekerjaan::count(),
            'totalKeluargas'   => Anggota::where('status_kk', 'Kepala Keluarga')->count(),
            'maleAnggotas'     => Anggota::where('jenis_kelamin', 'L')->count(),
            'femaleAnggotas'   => Anggota::where('jenis_kelamin', 'P')->count(),
        ]);
    }
}
