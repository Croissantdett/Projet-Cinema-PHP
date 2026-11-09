<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolePersonne extends Model{
    protected $table = 'role_personne';
    protected $primaryKey = 'idRolePer';
    public $timestamps = false;
    protected $fillable = [
      'libRolePer'
    ];
}
