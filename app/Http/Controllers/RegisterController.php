<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Division;
use App\Models\User;
use App\Models\UserDivision;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register', [
            'title' => 'Registration | SI-SULTAN',
            'header' => 'Registration',
            'divisions' => Division::all()
        ]);
    }

    public function store(RegisterRequest $request)
    {
        $validate = $request->all();

        if ($validate['role'] === "admin_bagian" || $validate['role'] === "kepala_bagian") {
            UserDivision::create($validate);
        }

        $validate['password'] = bcrypt($validate['password']);

        User::create($validate);

        return back();
    }
}
