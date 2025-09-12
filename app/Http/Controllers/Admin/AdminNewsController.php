<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsImage;
use Illuminate\Http\Request;
use App\Models\News;
use Inertia\Inertia;
use Storage;

class AdminNewsController extends Controller
{
    // Получение всех новостей с картинками
    public function index()
    {
        return Inertia::render('AdminPage', [
            'news' => News::with('images')->get(),
        ]);
    }

    // Создание новой новости
    public function store(Request $request)
    {
        $news = News::create($request->only('name', 'text', 'date'));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = 'storage/' . $file->store('news', 'public');
                $news->images()->create([
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Новость добавлена');
    }

    // Удаление новости и всех связанных картинок
    public function destroy(News $news)
    {
        foreach ($news->images as $image) {
            if (Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }
            $image->delete();
        }

        $news->delete();

        return redirect()->back();
    }
    public function update(Request $request, News $news)
    {
        $news->update($request->only('name', 'text', 'date'));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = 'storage/' . $file->store('news', 'public');
                $news->images()->create([
                    'image_path' => $path,
                ]);
            }
        }
        // dd($request->all(), $request->file());
          return redirect()->back()->with('success', 'новость успешно обновлена');
    }
    public function destroyImage($id)
{
    $image = NewsImage::findOrFail($id);

    if (Storage::disk('public')->exists($image->image_path)) {
        Storage::disk('public')->delete($image->image_path);
    }

    $image->delete();
   
return redirect()->back()->with('success', 'Изображение удалено');
}
}
