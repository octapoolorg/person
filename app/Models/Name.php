<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Name extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function genders(): BelongsToMany
    {
        return $this->belongsToMany(Gender::class, 'name_gender');
    }

    public function origins(): BelongsToMany
    {
        return $this->belongsToMany(Origin::class, 'name_origin');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'name_category');
    }
}
