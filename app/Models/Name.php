<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Name
 *
 * @mixin Builder
 */


class Name extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class, );
    }

    public function origins(): BelongsToMany
    {
        return $this->belongsToMany(Origin::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function scopeSearch(Builder $query, string $search): Builder
    {
        return $query->where('name', 'LIKE', "%$search%")->where('meaning', '!=', "");
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
