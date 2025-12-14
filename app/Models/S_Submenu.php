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
        's_view_name_id',
        's_model_key_id',
        's_redirect_to_id',
    ];

    public function menu()
    {
        return $this->belongsTo(S_Menu::class, 's_menu_id', 'id');
    }

    // PENTING: Pastikan nama tabel di sini sesuai dengan tabel di database
    public function viewName()
    {
        return $this->belongsTo(S_ViewName::class, 's_view_name_id', 'id');
    }

    public function modelKey()
    {
        return $this->belongsTo(S_ModelKey::class, 's_model_key_id', 'id');
    }

    public function redirectTo()
    {
        return $this->belongsTo(S_Redirect::class, 's_redirect_to_id', 'id');
    }
}
