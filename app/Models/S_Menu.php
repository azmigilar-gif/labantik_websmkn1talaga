<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class S_Menu extends Model
{
    protected $table = 's_menus';
    public $incrementing = false; // Karena bukan auto increment
    protected $keyType = 'string'; // UUID adalah string
    protected $fillable = [
        'id',
        'name',
        'slug'
    ];

    public function extrakulikulers()
    {
        return $this->hasMany(S_Extrakulikuler::class, 's_menu_id');
    }
}
