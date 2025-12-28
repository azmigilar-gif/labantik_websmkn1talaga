<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class GeminiController extends Controller
{

    public function ask(Request $request)
    {
        $request->validate([
            'prompt' => 'required|string'
        ]);

        $res = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.groq.key'),
            'Content-Type'  => 'application/json',
        ])->post('https://api.groq.com/openai/v1/chat/completions', [
            'model' => config('services.groq.model'),
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $request->prompt
                ]
            ],
            'temperature' => 0.7,
            'max_tokens' => 1500, // aman buat artikel sekolah
        ]);

        if ($res->failed()) {
            return response()->json([
                'error' => true,
                'status' => $res->status(),
                'body' => $res->body()
            ], 500);
        }

        return response()->json([
            'result' => $res->json('choices.0.message.content')
        ]);
    }
}
