<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class S_NewsLogs extends Model
{
    protected $table = 's_news_logs';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        's_news_id',      // ← TAMBAH
        's_tags_id',
    ];

    // Relasi ke News
    public function news()
    {
        return $this->belongsTo(S_News::class, 's_news_id');
    }

    // Relasi ke Menu
    public function menu()
    {
        return $this->belongsTo(S_Menu::class, 's_menu_id');
    }

    // Relasi ke Tag
    public function tag()
{
    return $this->belongsTo(S_Tags::class, 's_tags_id');
}
}
