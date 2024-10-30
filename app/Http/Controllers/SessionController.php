<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    function index() {
        return view('login', ['title' => 'Login SIMALAKAMA']);
    }


    function login(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong'
        ]);

        $infoLogin = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($infoLogin)) {
            $user = Auth::user();
            
            // Ambil semua role user
            $userRoles = $user->roles;
        
            // ni kalo punya banyak role
            if ($userRoles->count() > 1) {
                return redirect('select-role');
            }else{
                // ni kalo punya 1 role ajah
                $roleName = $userRoles->first()->name;
                if ($roleName == 'mahasiswa') {
                    return redirect('mhs');
                } elseif ($roleName == 'pembimbingakademik') {
                    return redirect('pa');
                } elseif ($roleName == 'kaprodi') {
                    return redirect('kaprodi');
                } elseif ($roleName == 'dekan') {
                    return redirect('dekan');
                } elseif ($roleName == 'bagianakademik') {
                    return redirect('ba');
                }

            }
        
        }else{
            return redirect('')->withErrors('Email dan password tidak terdaftar')->withInput();
        }
    }

    public function showSelectRolePage()
    {
        $roles = Auth::user()->roles; // Ambil semua role user
        return view('select-role', compact('roles'));
    }

    public function selectRole(Request $request)
    {
        $selectedRole = $request->input('role');

        if ($selectedRole == 'mahasiswa') {
            return redirect('mhs');
        } elseif ($selectedRole == 'pembimbingakademik') {
            return redirect('pa');
        } elseif ($selectedRole == 'kaprodi') {
            return redirect('kaprodi');
        } elseif ($selectedRole == 'dekan') {
            return redirect('dekan');
        } elseif ($selectedRole == 'bagianakademik') {
            return redirect('ba');
        }
    }

    function logout() {
        Auth::logout();
        return redirect('/');
    }
}
