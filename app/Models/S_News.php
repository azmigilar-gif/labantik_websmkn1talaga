<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class S_News extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 's_news';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    public $incrementing = false; // Karena bukan auto increment
    protected $keyType = 'string'; // UUID adalah string

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
        's_category_id',
        's_menu_id',
        'is_published',
        'created_by',
        'updated_by',
    ];

    public function categories()
    {
        // kept for backward compatibility if referenced, but it's incorrect; add proper relation below
        return $this->belongsTo(S_Categories::class, 's_category_id', 'id');
    }

    public function menu()
    {
        return $this->belongsTo(S_Menu::class, 's_menu_id', 'id');
    }

    /**
     * Proper belongsTo relation for a news item's category.
     */
    public function category()
    {
        return $this->belongsTo(S_Categories::class, 's_category_id', 'id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
