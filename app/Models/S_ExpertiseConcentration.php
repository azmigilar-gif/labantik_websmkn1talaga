<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class S_ExpertiseConcentration extends Model
{
    use HasUuids;

    protected $table = 's_expertise_concentrations';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id_concentrations',
        'description',
    ];

    public function core(): BelongsTo
    {
        return $this->belongsTo(CoreExpertiseConcentration::class, 'id_concentrations', 'id');
    }
}
