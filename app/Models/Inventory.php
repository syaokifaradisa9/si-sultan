<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function proposes()
    {
        return $this->hasMany(Propose::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }
}
