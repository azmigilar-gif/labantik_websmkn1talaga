<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class S_VisionMission extends Model
{
    protected $table = 's_vision_missions';
    public $incrementing = false; // Karena bukan auto increment
    protected $keyType = 'string'; // UUID adalah string
    protected $fillable = [
        'id',
        's_menu_id',
        'vision',
        'mission',
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
