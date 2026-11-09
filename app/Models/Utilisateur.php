<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model{
    protected $table = "utilisateur";
    protected $primaryKey = "idUti";
    public $timestamps = false;
    protected $fillable = [
        'nomUti',
        'prenomUti',
        'mailUti',
        'mdpUti',
        'ageUti',
        'idRoleUti'
    ];
    public function role(){
        return $this->belongsTo(RoleUtilisateur::class, 'idRoleUti', 'idRoleUti');
    }
}
