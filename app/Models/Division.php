<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function UserDivision()
    {
        return $this->hasMany(UserDivision::class);
    }

    public function InventoryHp()
    {
        return $this->hasMany(InventoryHp::class);
    }

    public function Inventories()
    {
        return $this->hasMany(Inventory::class);
    }
}
