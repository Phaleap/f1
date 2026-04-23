<?php
namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:100',
            'subject' => 'required|string|max:100',
            'message' => 'required|string|max:2000',
        ]);

        ContactMessage::create($validated);

        return back()->with('success', 'Message received. We\'ll get back to you within 24 hours.');
    }
}