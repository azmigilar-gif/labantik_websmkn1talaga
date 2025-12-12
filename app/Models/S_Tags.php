<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class S_Tags extends Model
{
    protected $table = 's_tags';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
    ];


    // Relasi ke NewsLogs
    public function newsLogs()
    {
        return $this->hasMany(S_NewsLogs::class, 's_tags_id');
    }
}
