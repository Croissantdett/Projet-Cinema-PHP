<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeSeance extends Model{
    protected $table = 'type_seance';
    protected $primaryKey = 'idTypeSea';
    public $timestamps = false;
    protected $fillable = [
        'libTypeSea',
    ];
}
