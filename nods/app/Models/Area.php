<?php

namespace App\Models;

use App\Models\Grado;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Area extends Model
{
    use HasFactory;

    public function grado(){

        return $this->belongsTo(Grado::class);
    }

    

    //Relación de uno a muchos inversa (de los alumnos hacia las areas)


}
