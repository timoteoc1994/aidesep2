<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function create()
    {
        // Muestra el formulario de creación de usuario
        return inertia('Welcome'); // <- componente Vue
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6'],
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if (auth()->user()->role->name === 'SuperAdmin') {
            $user->role_id = Role::where('name', 'AdminEmprendimientos')->first()->id;
        } elseif (auth()->user()->role->name === 'AdminEmprendimientos') {
            $user->role_id = Role::where('name', 'Emprendimiento')->first()->id;
        }

        $user->save();

        return redirect()->back()->with('message', 'Usuario creado correctamente.');
    }
}
