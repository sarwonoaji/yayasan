<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\LandingSection;
use App\Models\Page;
use App\Models\Setting;

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
        ]);
    }
}
