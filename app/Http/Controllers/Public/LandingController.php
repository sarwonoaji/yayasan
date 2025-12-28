<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\LandingSection;
use App\Models\News;
use App\Models\Setting;

class LandingController extends Controller
{
    public function index()
    {
        return view('public.landing', [
            'sections' => LandingSection::active()->get(),
            'latestNews' => News::published()
                                ->latest('published_at')
                                ->limit(6)
                                ->get(),
            'settings' => Setting::first(),
        ]);
    }
}
