<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuperadminController extends Controller
{
    public function index()
    {
        return view('roles.superadmin.index');
    }
}
