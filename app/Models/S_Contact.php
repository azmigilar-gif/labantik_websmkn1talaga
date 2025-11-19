<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class S_Contact extends Model
{
    protected $table = 's_contacts';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'address_1',
        'address_2',
        'email',
        'no_telp',
        's_menu_id',
        'created_by',
        'updated_by',
    ];

    public function menu()
    {
        return $this->belongsTo(S_Menu::class, 's_menu_id', 'id');
    }
}
