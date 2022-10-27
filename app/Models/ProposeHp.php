<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposeHp extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function divisionOrder()
    {
        return $this->belongsTo(DivisionOrder::class);
    }

    public function inventoryHp()
    {
        return $this->belongsTo(InventoryHp::class);
    }
}
