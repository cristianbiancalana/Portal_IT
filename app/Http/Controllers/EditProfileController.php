<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Gerencia;
use App\Models\Puesto;

class EditProfileController extends Controller
{
    public function showUser()
    {
        $user = Auth::user();
        $gerencias = Gerencia::all();
        $puestos = Puesto::all();
        return view('portal_it.layouts.edit_profile', compact('user', 'gerencias', 'puestos'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'gerencia' => 'required|string',
            'puesto' => 'required|string',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->gerencia = $request->gerencia;
        $user->puesto = $request->puesto;
        $user->save();

        return redirect()->back()->with('success', '¡Perfil actualizado exitosamente!');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'La contraseña actual no es válida.');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', '¡La contraseña ha sido cambiada exitosamente!');
    }
}
