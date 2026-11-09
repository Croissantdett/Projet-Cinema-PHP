<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salle extends Model{
    protected $table = 'salle';
    protected $primaryKey = 'idSal';
    public $timestamps = false;
    protected $fillable = [
        'numSal',
        'nbPlace'
    ];
    public function cinema() {
        return $this->belongsTo(Cinema::class, 'idCin', 'idCin');
    }
    public function typeSalle()
    {
        // Une salle appartient à un type via 'idTyp'.
        return $this->belongsTo(TypeSalle::class, 'idTyp', 'idTyp');
    }

}
