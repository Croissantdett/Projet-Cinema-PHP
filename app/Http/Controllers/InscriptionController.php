<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Reservation;

class InscriptionController extends Controller {
    public function showLogin()
    {
        return view('pages.Inscription')->with('success', 'Inscription réussie');
    }

    public function sign_in(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6'
        ], [
                'username.unique'   => "Ce nom d'utilisateur est déjà pris.",
                'password.min'      => "Le mot de passe doit contenir au moins 6 caractères."
            ]

        );

        $user= User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        $remember = $request->has('remember');
        Auth::login($user, $remember);
        $request->session()->regenerate();

        return redirect()->route('accueil')
            ->with('success', 'Inscription réussie');
    }

    public function sign_in_reservation(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6'
        ], [
                'username.unique'   => "Ce nom d'utilisateur est déjà pris.",
                'password.min'      => "Le mot de passe doit contenir au moins 6 caractères."
            ]

        );

        $user= User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        $remember = $request->has('remember');
        Auth::login($user, $remember);
        $request->session()->regenerate();
        $cinema = \App\Models\Cinema::inRandomOrder()->first();

        if(Session::has('reservation_seance')) {
            $IdSea = Session::get('reservation_seance');
            Reservation::firstOrCreate([
                'idUser' => Auth::id(),
                'idSea' => $IdSea
            ]);
            Session::forget('reservation_seance');
        }

        return redirect()->route('seance.show', $cinema->idCin)->with('success', 'Inscription et reservation réussie');
    }

    public function showRegistrationForm(Request $request)
    {
        $seance = null;
        if ($request->has('seance')) {
            $seance = \App\Models\Seance::find($request->seance);
        }

        return view('pages.inscription_reservation', compact('seance'));
    }
}
