<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Origin extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function names() {
        return $this->belongsToMany(Name::class);
    }

    public function meanings()
    {
        return $this->hasMany(Meaning::class);
    }
}
