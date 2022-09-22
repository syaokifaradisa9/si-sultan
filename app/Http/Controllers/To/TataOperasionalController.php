<?php

namespace App\Http\Controllers\To;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TataOperasionalController extends Controller
{
    public function index()
    {
        return view('roles.tata_operasionl.index');
    }
}
