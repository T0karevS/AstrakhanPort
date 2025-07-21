<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
  public function show($id)
{
    $newsItem = DB::table("news")
        ->leftJoin('news_images', 'news.id', '=', 'news_images.news_id')
        ->select(
            'news.id',
            'news.name',
            'news.date',
            'news.text',
            DB::raw('GROUP_CONCAT(news_images.image_path) as images_paths'),
            DB::raw('COUNT(news_images.id) as images_count')
        )
        ->where('news.id', $id)
        ->groupBy('news.id', 'news.name', 'news.date', 'news.text')
        ->first();

    if (!$newsItem) {
        abort(404);
    }

    $formattedItem = [
        'id' => $newsItem->id,
        'name' => $newsItem->name,
        'date' => $this->formatDate($newsItem->date),
        'text' => $newsItem->text,
        'images' => $newsItem->images_count > 0 
            ? explode(',', $newsItem->images_paths) 
            : []
    ];

    return Inertia::render('NewsPage', [
        'newsItem' => $formattedItem,
        'breadcrumbData' => [
            'newsTitle' => $newsItem->name
        ]
    ]);
}
 public function index()
{
    // Получаем все новости
    $news = DB::table("news")
        ->select("id", "name", "date", "text")
        ->orderBy('date', 'desc')
        ->get()
        ->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'date' => $this->formatDate($item->date),
                'text' => $item->text,
                'images' => [] // Инициализируем пустой массив для изображений
            ];
        })
        ->keyBy('id'); // Индексируем по id для быстрого доступа

    // Получаем все изображения
    $images = DB::table("news_images")
        ->select("id", "image_path", "news_id")
        ->get()
        ->groupBy('news_id'); // Группируем по news_id

    // Добавляем изображения к соответствующим новостям
    $news = $news->toArray(); // Преобразуем коллекцию в массив

foreach ($images as $newsId => $newsImages) {
    if (isset($news[$newsId])) {
        $news[$newsId]['images'] = $newsImages->pluck('image_path')->all();
    }
}

// Если нужно вернуть коллекцию
$news = collect($news);

    // Преобразуем обратно в обычный массив (если нужно)
    $news = array_values($news->all());
        
    return Inertia::render('News', [
        'news' => $news
    ]);
}
    private function formatDate($date)
    {
        return \Carbon\Carbon::parse($date)->format('d.m.Y');
    }   
}
