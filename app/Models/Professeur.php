<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professeur extends Model
{
    public function cours()
    {
        return $this->hasMany(Cours::class, 'professeur_id');
    }
}
