<?php

namespace App\Support;

use App\Models\S_NewsLogs;

class SubmenuData
{
    public static function map(): array
    {
        return [
            'newsLogs' => S_NewsLogs::class,
        ];
    }
}
