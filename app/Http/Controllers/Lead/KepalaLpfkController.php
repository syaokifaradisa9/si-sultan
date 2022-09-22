<?php

namespace App\Http\Controllers\Lead;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KepalaLpfkController extends Controller
{
    public function index()
    {
        return view('roles.kepala_lpfk.index');
    }
}
