<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Step extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'duration', 'action', 'order'];

    public function recipe(): BelongsTo
    {
        return $this->belongsTo(Recipe::class);
    }

    public function getTimeStringAttribute(): string
    {
        $totalMinutes = $this->duration;

        $hours = floor($totalMinutes / 60);
        $minutes = $totalMinutes - ($hours * 60);

        return ($hours > 0 ? $hours . 'h' : '') . ($minutes > 0 ? ($hours > 0 ? ' ' : '') . $minutes . 'm' : '');
    }
}
