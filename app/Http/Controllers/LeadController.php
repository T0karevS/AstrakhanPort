<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\LeadMail;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'message' => 'nullable|string',
        ]);

        Mail::to('frogerout@gmail.com')->send(new LeadMail($request->all()));

        return back()->with('success', 'Заявка отправлена');
    }
}