<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function cours()
    {
        return $this->belongsToMany(Cours::class, 'inscriptions');
    }
}
