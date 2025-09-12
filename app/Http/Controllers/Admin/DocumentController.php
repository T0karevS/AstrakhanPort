<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Storage;

class DocumentController extends Controller
{

    public function index()
    {

        return Inertia::render('AdminPage', [
            'documents' => Document::all(),
        ]);

    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'doc_name' => 'required|string|max:255',
            'doc_link' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:20480',
            'doc_category' => 'required|string',
            'doc_year' => 'required|string|size:4',
        ]);

        // Сохраняем файл в public/storage/documents
        $filePath = $request->file('doc_link')->store('documents', 'public');

        // Полный путь для проверки
        $fullPath = storage_path('app/public/' . $filePath);

        if (!file_exists($fullPath)) {
            return back()->withErrors(['doc_link' => 'Ошибка сохранения файла']);
        }

        Document::create([
            'doc_name' => $validated['doc_name'],
            'doc_link' => $filePath,
            'doc_category' => $validated['doc_category'],
            'doc_year' => $validated['doc_year'],
        ]);

        return redirect()->back()->with('success', 'Документ успешно добавлен');
    }

    public function update(Request $request, Document $document)
    {
        $validated = $request->validate([
            'doc_name' => 'required|string|max:255',
            'doc_category' => 'required|string|max:255',
            'doc_year' => 'required|digits:4',
            'doc_link' => 'nullable|file', // <-- обязательно nullable
        ]);

        if ($request->hasFile('doc_link')) {
            $validated['doc_link'] = $request->file('doc_link')->store('documents', 'public');
        }

        $document->update($validated);

        if ($request->hasFile('doc_link')) {
            $path = $request->file('doc_link')->store('documents', 'public');
            $validated['doc_link'] = $path;
        }

        $document->update($validated);
        return redirect()->back()->with('success', 'Документ успешно обновлен');
        // return redirect()->route('documents')->with('success', 'Документ обновлён');
    }

    public function destroy(Document $document)
    {
        // Опционально: удалить файл из хранилища перед удалением записи
        if ($document->doc_link && Storage::disk('public')->exists($document->doc_link)) {
            Storage::disk('public')->delete($document->doc_link);
        }

        $document->delete();
        return redirect()->back();
    }
}
