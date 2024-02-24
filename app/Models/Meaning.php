<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meaning extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function name()
    {
        return $this->belongsTo(Name::class);
    }

    public function origin()
    {
        return $this->belongsTo(Origin::class);
    }
}
