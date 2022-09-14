<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDivisiController extends Controller
{
    public function index()
    {
        return view('roles.admin.index');
    }
}
