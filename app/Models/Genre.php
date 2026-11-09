<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model{
    protected $table = 'genre';
    protected $primaryKey = 'idGenre';
    public $timestamps = false;

    protected $fillable = [
        'libGenre'
    ];
    public function films()
    {
        return $this->hasMany(Film::class, 'idGenre', 'idGenre');
    }
}
