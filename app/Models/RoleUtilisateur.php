<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUtilisateur extends Model{
    protected $table ='role_utilisateur';
    protected $primaryKey = "idRoleUti";
    public $timestamps = false;
    protected $fillable = [
        'LibRoleUti'
    ];
    public function utilisateur(){
        return $this->hasMany(Utilisateur::class, 'idRoleUti', 'idRoleUti');
    }
}
