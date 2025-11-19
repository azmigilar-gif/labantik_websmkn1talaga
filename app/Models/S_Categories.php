<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class S_Categories extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 's_categories';

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
        'name',
        'is_active',
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
