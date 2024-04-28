<?php

namespace App\Models;

use App\Models\settings\Period;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Level extends Model
{
    use HasFactory;

    protected $fillable = [
        'period_id',
        'name',
        'shift',
        'state'
    ];

    public function period(): BelongsTo
    {
        return $this->belongsTo(Period::class);
    }
}
