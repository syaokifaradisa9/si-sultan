<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiveHp extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function proposeHp()
    {
        return $this->belongsTo(ProposeHp::class);
    }
}
