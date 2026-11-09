<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participe extends Model{
    protected $table = 'participe';
    protected $primaryKey = 'idParticipe';
    public $timestamps = false;

    protected $fillable = [
        'idPer',
        'idFil',
        'idRolePer',
    ];

}
