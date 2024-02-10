<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder as QueryBuilder;

/**
 * Name
 *
 *
 *
 * @mixin QueryBuilder
 */
class Name extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['gender'];

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }

    public function origins(): BelongsToMany
    {
        return $this->belongsToMany(Origin::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeSearch(Builder $query, string $search): Builder
    {
        return $query->where('name', 'LIKE', "%$search%");
    }

    public function scopeRandom(Builder $query): Builder
    {
        return $query->inRandomOrder();
    }

    public function isBoy(): bool
    {
        return $this->gender->slug === 'masculine';
    }

    public function isGirl(): bool
    {
        return $this->gender->slug === 'feminine';
    }

    public function scopePopular(Builder $query): Builder
    {
        return $query->where('is_popular', true);
    }

    public function scopeValidMeaning(Builder $query): Builder
    {
        return $query->where('generated', false);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('is_active', true);
        });
    }
}
