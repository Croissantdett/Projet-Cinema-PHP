<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Langue extends Model
{
    protected $table = 'langue';
    protected $primaryKey = 'idLangue';
    public $timestamps = true;

    protected $fillable = ['LangueSea'];
}
