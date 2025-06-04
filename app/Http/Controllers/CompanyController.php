<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class CompanyController extends Controller
{

        // О компании (/company/about)
    public function about()
    {
        return Inertia::render('Company/About', [
            'pageTitle' => 'О компании',
            'companyInfo' => [
                'name' => 'Название компании',
                'description' => 'Описание деятельности...',
            ],
        ]);
    }

    // Документы (/company/documents)
    public function documents()
    {
        return Inertia::render('Company/Documents', [
            'pageTitle' => 'Документы',
            'documents' => Document::latest()->get(),
        ]);
    }

    // Отчеты по доходам и расходам (/company/financial-reports)
    public function financialReports()
    {
        return Inertia::render('Company/FinancialReports', [
            'pageTitle' => 'Отчеты по доходам и расходам',
            'reports' => FinancialReport::with('category')->get(),
        ]);
    }

    // Годовой отчет; закупки (/company/annual-procurement)
    public function annualProcurement()
    {
        return Inertia::render('Company/AnnualProcurement', [
            'pageTitle' => 'Годовой отчет и закупки',
            'annualReports' => AnnualReport::latest()->get(),
            'procurements' => Procurement::active()->get(),
        ]);
    }

    // Раскрытие информации (/company/disclosure)
    public function disclosure()
    {
        return Inertia::render('Company/Disclosure', [
            'pageTitle' => 'Раскрытие информации',
            'disclosures' => Disclosure::orderedByDate()->get(),
        ]);
    }

    // План развития (/company/development-plan)
    public function developmentPlan()
    {
        return Inertia::render('Company/DevelopmentPlan', [
            'pageTitle' => 'План развития',
            'plans' => DevelopmentPlan::with('milestones')->get(),
        ]);
    }

    // Протоколы собраний (/company/meeting-minutes)
    public function meetingMinutes()
    {
        return Inertia::render('Company/MeetingMinutes', [
            'pageTitle' => 'Протоколы собраний',
            'minutes' => MeetingMinutes::latest()->paginate(10),
        ]);
    }

    // Реквизиты (/company/requisites)
    public function requisites()
    {
        return Inertia::render('Company/Requisites', [
            'pageTitle' => 'Реквизиты компании',
            'requisites' => [
                'legal_address' => 'г. Москва, ул. Примерная, 123',
                'inn' => '1234567890',
                'kpp' => '987654321',
                'bank_details' => '...',
            ],
        ]);
    }
}
