<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'number_of_people'];

    public function ingredients(): HasMany
    {
        return $this->hasMany(Ingredient::class);
    }

    public function steps(): HasMany
    {
        return $this->hasMany(Step::class)->orderBy('order');
    }

    public function getNextAttribute()
    {
        return self::where('id', '>', $this->id)->orderBy('id')->first();
    }

    public function getPreviousAttribute()
    {
        return self::where('id', '<', $this->id)->orderByDesc('id')->first();
    }

    public function getTotalTimeAttribute(): int
    {
        $totalMinutes = 0;

        foreach ($this->steps as $step) {
            $totalMinutes += $step->duration;
        }

        return $totalMinutes;
    }

    public function getTotalTimeStringAttribute(): string
    {
        $totalMinutes = $this->total_time;

        $hours = floor($totalMinutes / 60);
        $minutes = $totalMinutes - ($hours * 60);

        return ($hours > 0 ? $hours . 'h' : '') . ($minutes > 0 ? ($hours > 0 ? ' ' : '') . $minutes . 'm' : '');
    }
}
