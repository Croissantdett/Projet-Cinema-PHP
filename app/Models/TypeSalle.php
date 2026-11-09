<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeSalle extends Model{
    protected $table = 'type_salle';
    protected $primaryKey = 'idTyp';
    public $timestamps = false;
    protected $fillable = [
        'libTypeSal',
    ];
    public function salles()
    {
        return $this->hasMany(Salle::class, 'idTyp', 'idTyp');
    }
}

