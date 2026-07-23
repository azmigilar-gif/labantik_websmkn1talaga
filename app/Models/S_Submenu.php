<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class S_Submenu extends Model
{
    protected $table = 's_submenus';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        's_menu_id',
        'name',
        'url',
        'type',
        'content',
        'external_url',
        'module_name',
    ];

    public function menu()
    {
        return $this->belongsTo(S_Menu::class, 's_menu_id', 'id');
    }
}
