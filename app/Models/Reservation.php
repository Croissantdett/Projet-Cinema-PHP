<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model{
    protected $table ='reservation';
    protected $primaryKey = 'idRes';
    public $timestamps = false ;
    protected $fillable=[
        'idUser',
        'idSea'
    ];
    public function concerners()
    {
        return $this->hasMany(Concerner::class, 'idRes');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }
    public function seance()
    {
        return $this->belongsTo(Seance::class, 'idSea');
    }
}
