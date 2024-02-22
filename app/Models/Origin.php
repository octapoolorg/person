<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Origin extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function name()
    {
        return $this->belongsTo(Name::class);
    }

    public function meanings()
    {
        return $this->hasMany(Meaning::class);
    }
}
