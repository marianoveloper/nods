<?php

namespace App\Models;

use App\Models\Area;
use App\Models\Periodo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grado extends Model
{
    use HasFactory;

    public function period(){

        return $this->belongsTo(Periodo::class);
    }

    public function areas(){

        return $this->hasMany(Area::class);
    }

    public function cursos(){

        return $this->hasMany(Curso::class);
    }

    public function users(){

        return $this->belongsToMany(User::class);
    }
}
