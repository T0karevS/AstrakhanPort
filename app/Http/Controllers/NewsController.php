<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function index()
    {
        $news = DB::table("news")
            ->select("id", "name", "date", "text")
            ->orderBy('date', 'desc')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'date' => $this->formatDate($item->date),
                    'text' => $item->text
                ];
            });
        // dd($news);  
        return Inertia::render('News', [
            'news' => $news
        ]);
    }

    private function formatDate($date)
    {
        return \Carbon\Carbon::parse($date)->format('d.m.Y');
    }   
}
