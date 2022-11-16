<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryHp extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function proposeHp()
    {
        return $this->hasMany(ProposeHp::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }
}
