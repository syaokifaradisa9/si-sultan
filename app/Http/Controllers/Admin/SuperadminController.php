<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Http\Request;
use App\Models\UserDivision;
use App\Models\User;

class SuperadminController extends Controller
{
    public function index()
    {
        return view('roles.superadmin.index', [
            'header' => 'Beranda Superadmin',
            'users'  => User::all(),
            'user_divisions' => UserDivision::all(),
            'divisions' => Division::all()
        ]);
    }

    public function delete($id)
    {
        $data = User::find($id);
        $data->delete();
        return redirect()->route('admin.home')->with('success', 'Data berhasil dihapus!');
    }
    public function deleteUserDiv($id)
    {
        $data = UserDivision::find($id);
        $data->delete();
        return redirect()->route('admin.home')->with('success', 'Data berhasil dihapus!');
    }
}
