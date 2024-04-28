<?php

namespace App\Models\settings;

use App\Models\Level;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Period extends Model
{
    use HasFactory;

    protected $fillable = [
        'period',
        'state'
    ];

    public function levels(): HasMany
    {
        return $this->hasMany(Level::class);
    }
}
