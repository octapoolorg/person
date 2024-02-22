<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nickname extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function name()
    {
        return $this->belongsTo(Name::class);
    }
}
