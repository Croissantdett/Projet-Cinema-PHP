<?php

namespace App\Http\Controllers;

use App\Models\Seance;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ReservationController extends Controller
{
    public function reservation($IdSea)
    {
        if (!Auth::check()) {
            Session::put('reservation_seance', $IdSea);
            $seance = Seance::with(['film','salle','typeSeance'])
                ->find($IdSea);
            return view('pages.connexion_reservation', compact('seance'));
        }



        Reservation::firstOrCreate([
            'idUser' => Auth::id(),
            'idSea' => $IdSea
        ]);

        $cinema = \App\Models\Cinema::inRandomOrder()->first();
        return redirect()->route('seance.show', $cinema->idCin)->with('success', 'Réservation réussie');
    }

    public function mesReservations()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $now = now();

        // Réservations à venir
        $reservationsAVenir = Reservation::with([
            'seance.film',
            'seance.salle',
            'seance.langue',
            'seance.typeSeance'
        ])
            ->where('idUser', Auth::id())
            ->whereHas('seance', function ($query) use ($now) {
                $query->where('dateHeurSea', '>=', $now);
            })
            ->orderBy('idRes', 'desc')
            ->get();

        // Réservations passées
        $reservationsPassees = Reservation::with([
            'seance.film',
            'seance.salle',
            'seance.langue',
            'seance.typeSeance'
        ])
            ->where('idUser', Auth::id())
            ->whereHas('seance', function ($query) use ($now) {
                $query->where('dateHeurSea', '<', $now);
            })
            ->orderBy('idRes', 'desc')
            ->get();


        return view('pages.mes-reservations', compact('reservationsAVenir', 'reservationsPassees'));
    }
}
