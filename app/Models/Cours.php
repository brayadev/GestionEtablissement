<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cours extends Model
{

    public function professeur()
    {
        return $this->belongsTo(Professeur::class, 'professeur_id');
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function etudiants()
    {
        return $this->belongsToMany(Etudiant::class, 'inscriptions');
    }

}
