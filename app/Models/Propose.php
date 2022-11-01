<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propose extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function divisionOrder()
    {
        return $this->belongsTo(DivisionOrder::class);
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function receives()
    {
        return $this->hasMany(Receive::class);
    }
}
