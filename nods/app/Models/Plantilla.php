<?php

namespace App\Models;

use App\Models\Curso;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plantilla extends Model
{
    use HasFactory;

    public function cursos(){

        return $this->hasMany(Curso::class);
    }
}
