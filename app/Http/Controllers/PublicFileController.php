<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PublicFileController extends Controller
{
    /**
     * Serve files from storage/app/public safely.
     * Example: /files/ekstrakulikuler/images/2025/11/17/foo.jpg maps to storage/app/public/images/2025/11/17/foo.jpg
     */
    public function serveFromStorage(Request $request, $path)
    {
        // normalize path and prevent path traversal
        $path = ltrim($path, '/');
        $base = realpath(storage_path('app/public'));
        if ($base === false) {
            abort(404);
        }

        $full = realpath($base . DIRECTORY_SEPARATOR . $path);
        if ($full === false || !str_starts_with($full, $base)) {
            abort(404);
        }

        if (!is_file($full) || !is_readable($full)) {
            abort(404);
        }

        $mime = mime_content_type($full) ?: 'application/octet-stream';

        return response()->file($full, [
            'Content-Type' => $mime,
            'Cache-Control' => 'public, max-age=31536000',
        ]);
    }
}
