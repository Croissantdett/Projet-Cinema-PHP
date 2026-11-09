<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seance extends Model{
    protected $table = 'seance';
    protected $primaryKey = 'idSea';
    public $timestamps= false;
    protected $fillable = [
        'dateHeurSea',
        'idFil',
        'idSal',
        'idTypeSea',
        'idLangue',
    ];
    public function concerners()
    {
        return $this->hasMany(Concerner::class, 'idSea');
    }
    public function salle() {
        return $this->belongsTo(Salle::class, 'idSal', 'idSal');
    }
    public function film()
    {
        return $this->belongsTo(Film::class, 'idFil', 'idFil');
    }
    public function langue(){
        return $this->belongsTo(Langue::class, 'idLangue', 'idLangue');

    }
    public function typeSeance() {
        return $this->belongsTo(TypeSeance::class, 'idTypeSea');
    }
}
