<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Inertia\Inertia;
use App\Models\Vacancy;
use App\Models\News;

class AdminController extends Controller
{
    public function index()
{
    return Inertia::render('AdminPage', [
        'documents' => Document::all(),
        'vacancies' => Vacancy::all(),
        'news' => News::with('images')->get(),
    ]);
}
}
