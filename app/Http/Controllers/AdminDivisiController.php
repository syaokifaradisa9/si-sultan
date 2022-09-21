<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\InventoryHp;

class AdminDivisiController extends Controller
{
    public function index()
    {
        $inventory = Inventory::all();
        $inventory_hp = InventoryHp::all();
        return view('roles.admin.index', ['inventories' => $inventory, 'inventory_hps' => $inventory_hp, 'title' => 'Inventory Barang', 'header' => 'Inventory Barang']);
    }
}
