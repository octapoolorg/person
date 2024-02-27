<?php

namespace App\Models;

use App\Enums\Gender;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Name extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function origins()
    {
        return $this->belongsToMany(Origin::class, 'name_origin');
    }

    public function meanings()
    {
        return $this->hasMany(Meaning::class);
    }

    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }

    public function nicknames()
    {
        return $this->hasMany(Nickname::class);
    }

    public function similarNames()
    {
        return $this->belongsToMany(Name::class, 'name_similar', 'name_id', 'similar_name_id')->withoutGlobalScopes();
    }

    public function siblingNames()
    {
        return $this->belongsToMany(Name::class, 'name_sibling', 'name_id', 'sibling_name_id')->withoutGlobalScopes();
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function isMasculine(): bool
    {
        return $this->gender === Gender::MASCULINE->value;
    }

    public function isFeminine(): bool
    {
        return $this->gender === Gender::FEMININE->value;
    }

    public function scopeValidGender(Builder $query): Builder
    {
        return $query->whereIn("gender", [
            Gender::MASCULINE->value,
            Gender::FEMININE->value
        ]);
    }

    public function scopePopular(Builder $query): Builder
    {
        return $query->where('is_popular', true);
    }

    public function scopeRandom(Builder $query): Builder
    {
        return $query->inRandomOrder();
    }

    public function scopeSearch(Builder $query, string $search): Builder
    {
        return $query->where('name', 'LIKE', "$search%");
    }

    public function scopeSimple(Builder $query): Builder
    {
        return $query->where('is_simple', true);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('is_active', true);
        });
    }
}
