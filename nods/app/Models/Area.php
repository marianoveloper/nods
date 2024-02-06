<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    public function grado(){

        return $this->belongsTo(Grado::class);
    }

    //Relación de uno a muchos inversa (de los alumnos hacia las areas)


}
