<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserDivision extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // protected $table = 'user_divisions';

    protected $guarded = ['id'];

    public function divisions()
    {
        return $this->belongsTo(Division::class);
    }

    public function divisionOrders()
    {
        return $this->hasMany(DivisionOrder::class);
    }
}
