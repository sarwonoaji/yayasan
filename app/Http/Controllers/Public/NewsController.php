<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        return view('public.news.index', [
            'news' => News::published()
                        ->latest('published_at')
                        ->paginate(6)
        ]);
    }

    public function show($slug)
    {
        $news = News::published()
                    ->where('slug', $slug)
                    ->firstOrFail();

        return view('public.news.show', compact('news'));
    }
}
