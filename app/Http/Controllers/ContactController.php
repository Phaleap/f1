<?php
namespace App\Http\Controllers;
use App\Models\ContactMessage;
use App\Services\TelegramService;
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

        // Notify admin via Telegram
        try {
            $telegram = new TelegramService();
            $telegram->notifyAdmin(
                "📩 <b>New Contact Message</b>\n\n" .
                "👤 Name: {$validated['name']}\n" .
                "📧 Email: {$validated['email']}\n" .
                "📋 Subject: {$validated['subject']}\n\n" .
                "💬 Message:\n{$validated['message']}"
            );
        } catch (\Exception $e) {
            // Silently fail — don't block the user
        }

        return back()->with('success', 'Message received. We\'ll get back to you within 24 hours.');
    }
}