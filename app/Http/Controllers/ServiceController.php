<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ServiceController extends Controller
{
    public function index($section = null)
    {
        // Если section не указан или невалиден - используем 'about'
        $validSections = ['export', 'import', 'termoobrabotka','morskie-gruzoperevozki', 'tamozhnya', 'teo', 'khranenie', 'zh-d-gruzoperevozki'];
        $currentSection = in_array($section, $validSections) ? $section : 'about';
        
        return Inertia::render('ServicePage', [
            'initialSection' => $currentSection
        ]);
    }
}
