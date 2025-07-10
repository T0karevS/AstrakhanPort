<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    public function index($section = null)
{
    $validSections = ['about', 'documents', 'plans', 'vacancy', 'requisites',];
    $currentSection = in_array($section, $validSections) ? $section : 'about';
    
    $groupedDocuments = [];
    
    if ($currentSection === 'documents') {
        $documents = DB::table('documents')
            ->select('id', 'doc_name', 'doc_link', 'doc_category', 'doc_year')
            ->get();
        
        $groupedDocuments = $documents->groupBy('doc_category')->toArray();
    }
    $vacancies = [];
    
    if ($currentSection === 'vacancy') {
        $vacancies = DB::table('vacancies')
            ->select('id', 'name', 'salary', 'description', 'experience', 'employment')
            ->get()
            ->toArray();
    }
    return Inertia::render('Company', [
        'initialSection' => $currentSection,
        'documentsData' => $groupedDocuments ?: new \stdClass(),
        'vacanciesData' => $vacancies ?: new \stdClass(),
    ]);
}
}