<?php
//
//namespace App\Models;
//
//use Illuminate\Database\Eloquent\Model;
///**
// * @method static has(string $string)
// */
//class Film extends Model{
//    protected $table = 'film';
//    protected $primaryKey = 'idFil';
//    public $timestamps = false;
//    protected $fillable = [
//        'titreFil',
//        'descFil',
//        'imgFil',
//        'dureFil',
//        'idGenre'
//    ];
//
//    public function genre()
//    {
//        return $this->belongsTo(Genre::class, 'idGenre', 'idGenre');
//    }
//    public function seances() {
//        return $this->hasMany(Seance::class, 'idFil', 'idFil');
//    }
//    public function realisateurs()
//    {
//        return $this->belongsToMany(Personne::class, 'participe', 'idFil', 'idPer')
//            ->whereHas('roles', function($q) {
//                $q->where('libRolePer', 'Réalisateur');
//            })
//            ->withPivot('idRolePer');
//    }
//
//    public function acteursPrincipaux()
//    {
//        return $this->belongsToMany(Personne::class, 'participe', 'idFil', 'idPer')
//            ->whereHas('roles', function($q) {
//                $q->where('libRolePer', 'Acteur principal');
//            })
//            ->withPivot('idRolePer');
//    }
//    public function scenaristes()
//    {
//        return $this->belongsToMany(Personne::class, 'participe', 'idFil', 'idPer')
//            ->whereHas('roles', function ($q) {
//                $q->where('libRolePer', 'Scenariste');
//            })
//            ->withPivot('idRolePer');
//    }
//}


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $table = 'film';
    protected $primaryKey = 'idFil';
    public $timestamps = false;

    protected $fillable = [
        'titreFil',
        'descFil',
        'imgFil',
        'dureFil',
        'idGenre'
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class, 'idGenre', 'idGenre');
    }

    public function seances()
    {
        return $this->hasMany(Seance::class, 'idFil', 'idFil');
    }

    public function personnes()
    {
        return $this->belongsToMany(Personne::class, 'participe', 'idFil', 'idPer')
            ->withPivot('idRolePer');
    }

    public function acteurs()
    {
        return $this->personnes()->wherePivot('idRolePer', 2);
    }

    public function acteursPrincipaux()
    {
        return $this->personnes()->wherePivot('idRolePer', 2);
    }

    public function realisateurs()
    {
        return $this->personnes()->wherePivot('idRolePer', 1 );
    }

    public function scenaristes()
    {
        return $this->personnes()->wherePivot('idRolePer', 3);
    }
}
