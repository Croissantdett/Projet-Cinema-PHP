<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarif extends Model{
    protected $table ='tarif';
    protected $primaryKey = 'idTar';
    public $timestamps = false;
    protected $fillable = [
        'libTar',
        'prixTar',
    ];
    public function concerners()
    {
        return $this->hasMany(Concerner::class, 'idTar');
    }

}
