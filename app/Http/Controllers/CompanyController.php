<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class CompanyController extends Controller
{
    public function index($section = null)
    {
        // Если section не указан или невалиден - используем 'about'
        $validSections = ['about', 'documents', 'plans', 'vacancy'];
        $currentSection = in_array($section, $validSections) ? $section : 'about';
        
        return Inertia::render('Company', [
            'initialSection' => $currentSection
        ]);
    }
}