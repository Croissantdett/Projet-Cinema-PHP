<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Concerner extends Model{
    protected $table = 'concerner';
    public $timestamps = false;
    protected $fillable = [
        'idRes',
        'idTar',
        'idSea',
        'nbPer'
    ];
    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'idRes');
    }
    public function tarif()
    {
        return $this->belongsTo(Tarif::class, 'idTar');
    }

    public function seance()
    {
        return $this->belongsTo(Seance::class, 'idSea');
    }
}
