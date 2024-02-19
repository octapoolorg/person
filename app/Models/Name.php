<?php

namespace App\Models;

use App\Enums\Gender as GenderEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        return $query->where('name', 'LIKE', "$search%");
    }

    public function scopeRandom(Builder $query): Builder
    {
        return $query->inRandomOrder();
    }

    public function isMasculine(): bool
    {
        return $this->gender->slug === GenderEnum::MASCULINE->value;
    }

    public function isFeminine(): bool
    {
        return $this->gender->slug === GenderEnum::FEMININE->value;
    }

    public function scopeValidGender(Builder $query): Builder
    {
        return $query->whereHas('gender', function (Builder $query) {
            $query->whereIn('slug', [GenderEnum::MASCULINE->value, GenderEnum::FEMININE->value]);
        });
    }

    public function scopePopular(Builder $query): Builder
    {
        return $query->where('is_popular', true);
    }

    public function scopeSimple(Builder $query): Builder
    {
        return $query->where('is_simple', true);
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
        static::addGlobalScope('active_simple', function (Builder $builder) {
            $builder->where('is_active', true)->where('is_simple', true);
        });
    }
}
