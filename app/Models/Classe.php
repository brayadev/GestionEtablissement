<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    //use HasFactory;

    protected $fillable = ['name', 'level', 'capacity'];

    public function etudiants()
    {
        return $this->hasMany(Etudiant::class);
    }

    public function cours()
    {
        return $this->belongsToMany(Cours::class, 'classe_cours');
    }
}
