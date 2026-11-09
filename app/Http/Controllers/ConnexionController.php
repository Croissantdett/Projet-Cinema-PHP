<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Reservation;

class ConnexionController extends Controller {
    public function showLogin()
    {
        return view('pages.Connexion');
    }

    public function login(Request $request)
    {
        //dd("Connexion OK");

        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('username', 'password');
        $remember = $request->has('remember');

        //dd(Auth::attempt($credentials));
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->route('accueil')
                ->with('success', 'Connexion effectuée');
        }

        return back()->withErrors([
            'username' => 'Identifiants incorrects'
        ]);

    }

    public function login_reservation(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('username', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
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
            return redirect()->route('seance.show', $cinema->idCin)->with('success', 'Connexion et reservation effectuée');
        }

        return back()->withErrors([
            'username' => 'Identifiants incorrects'
        ]);

    }

    public function showLoginForm(Request $request)
    {
        $seance = null;
        if ($request->has('seance')) {
            $seance = \App\Models\Seance::find($request->seance);
        }

        return view('pages.connexion_reservation', compact('seance'));
    }


}
