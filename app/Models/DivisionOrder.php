<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivisionOrder extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function userDivision()
    {
        return $this->belongsTo(UserDivision::class);
    }

    public function propose()
    {
        return $this->hasMany(Propose::class);
    }

    public function proposeHp()
    {
        return $this->hasMany(ProposeHp::class);
    }
}
