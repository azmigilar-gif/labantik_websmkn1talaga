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

        $payload = [
            [
                "role" => "user",
                "content" => $request->prompt
            ]
        ];

        $res = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => '*/*'
        ])->post('https://api.siputzx.my.id/api/ai/gpt3', $payload);
        // dd($res->json());


        if ($res->failed()) {
            return response()->json([
                'error' => true,
                'status' => $res->status(),
                'body' => $res->body()
            ], 500);
        }

        $json = $res->json();

        return response()->json([
            'result' => $json['data'] ?? ''
        ]);
    }
}
