<?php

namespace App\Http\Controllers\Adum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdministrasiUmumController extends Controller
{
    public function index()
    {
        return view('roles.administrasi_umum.index');
    }
}
