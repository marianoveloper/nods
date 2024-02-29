<?php

namespace App\Models;

use App\Models\Grado;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Periodo extends Model
{
    use HasFactory;

    public function grados(){
        return $this->hasMany(Grado::class);
    }
}
