<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class S_News extends Model
{
    protected $table = 's_news';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'title',
        'content',
        's_category_id',
        's_menu_id',
        'is_published',
        'approve',        // ← TAMBAH
        'created_by',
        'updated_by',
    ];

    // Relasi ke Category
    public function categories()
    {
        return $this->belongsTo(S_Categories::class, 's_category_id', 'id');
    }

    // Relasi ke Menu
    public function menu()
    {
        return $this->belongsTo(S_Menu::class, 's_menu_id', 'id');
    }

    // Relasi Many-to-Many ke Tags (PERBAIKAN UTAMA)
    public function tags()
    {
        return $this->belongsToMany(
            S_Tags::class,       // Model yang direlasikan
            's_news_logs',       // Nama pivot table
            's_news_id',         // Foreign key di pivot untuk model ini (S_News)
            's_tags_id',         // Foreign key di pivot untuk model yang direlasikan (S_Tags)
            'id',                // Local key di S_News
            'id'                 // Local key di S_Tags
        );
    }

    // Relasi ke NewsLogs (untuk mengakses pivot langsung jika perlu)
    public function newsLogs()
    {
        return $this->hasMany(S_NewsLogs::class, 's_news_id');
    }

    // Relasi ke User (created_by)
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    // Relasi ke User (updated_by)
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
