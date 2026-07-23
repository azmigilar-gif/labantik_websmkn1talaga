<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class S_Achievement extends Model
{
    protected $table = 's_achievement';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'title',
        'category',
        'date',
        'winner_name',
        'winner_social',
        'description',
        'photo',
        'created_by',
        'updated_by',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
