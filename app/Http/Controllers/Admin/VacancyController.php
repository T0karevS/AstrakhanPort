<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Inertia\Inertia;

class VacancyController extends Controller
{
    // Список всех вакансий
    public function index()
{
    $vacancies = Vacancy::all();       
    dd($vacancies);   
    return Inertia::render('AdminVacancies', [
        'vacancies' => $vacancies,
    ]);
}

    // Создание новой вакансии
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'salary' => 'required|string|max:255',
            'experience' => 'required|string|max:255',
            'description' => 'required|string',
            'employment' => 'required|string|max:255',
        ]);

        Vacancy::create($validated);

        return redirect()->back()->with('success', 'Вакансия успешно добавлена');
    }

    // Обновление вакансии
    public function update(Request $request, Vacancy $vacancy)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'salary' => 'required|string|max:255',
            'experience' => 'required|string|max:255',
            'description' => 'required|string',
            'employment' => 'required|string|max:255',
        ]);

        $vacancy->update($validated);

        return redirect()->back()->with('success', 'Вакансия успешно обновлена');
    }

    // Удаление вакансии
    public function destroy(Vacancy $vacancy)
    {
        $vacancy->delete();
        return redirect()->back()->with('success', 'Вакансия успешно удалена');
    }
}