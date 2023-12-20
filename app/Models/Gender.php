<?php

namespace App\Models;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/*
 * App\Models\Gender
 *
 * @package App\Models
 * @mixin Builder
 */

class Gender extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function names(): HasMany
    {
        return $this->hasMany(Name::class);
    }

}
