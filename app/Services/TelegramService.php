<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramService
{
    protected string $token;
    protected string $adminChatId;

    public function __construct()
    {
        $this->token       = config('services.telegram.token');
        $this->adminChatId = config('services.telegram.admin_chat_id');
    }

    public function send(string $chatId, string $message): void
    {
        try {
            Http::post("https://api.telegram.org/bot{$this->token}/sendMessage", [
                'chat_id'    => $chatId,
                'text'       => $message,
                'parse_mode' => 'HTML',
            ]);
        } catch (\Exception $e) {
            Log::error('Telegram send failed: ' . $e->getMessage());
        }
    }

    public function notifyAdmin(string $message): void
    {
        $this->send($this->adminChatId, $message);
    }
}