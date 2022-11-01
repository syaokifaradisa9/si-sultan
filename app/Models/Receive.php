<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receive extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function propose()
    {
        return $this->belongsTo(Propose::class);
    }
}
