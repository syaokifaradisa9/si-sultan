<?php

namespace App\Http\Controllers\Ppk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PpkController extends Controller
{
    public function index()
    {
        return view('roles.ppk.index');
    }
}