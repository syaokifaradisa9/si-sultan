<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDivision extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function divisions()
    {
        return $this->belongsTo(Division::class);
    }
}
