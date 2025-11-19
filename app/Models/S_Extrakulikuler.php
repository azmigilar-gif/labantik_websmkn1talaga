<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class S_Extrakulikuler extends Model
{
    protected $table = 's_extrakulikulers';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'photo',
        'description',
        's_menu_id',
        'created_by',
        'updated_by',
    ];

    public function menu()
    {
        return $this->belongsTo(S_Menu::class, 's_menu_id', 'id');
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
