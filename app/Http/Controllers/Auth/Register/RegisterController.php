<?php

namespace App\Http\Controllers\Auth\Register;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Division;
use App\Models\User;
use App\Models\UserDivision;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register.index', [
            'title' => 'Registration | SI-SULTAN',
            'header' => 'Registration',
            'divisions' => Division::all()
        ]);
    }

    public function store(RegisterRequest $request)
    {
        $validate = $request->all();

        $validate['password'] = bcrypt($validate['password']);

        if ($validate['role'] === "admin_divisi" || $validate['role'] === "kepala_divisi") {
            UserDivision::create($validate);
        } else {
            User::create($validate);
        }

        return redirect()->route('login');
    }
}
