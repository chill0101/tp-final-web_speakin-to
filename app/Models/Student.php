<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'dni',
        'email',
        'birth_date',
        'phone',
        'address',
        'gender',
        'active',
    ];
// 1) Alumnos:  
// Campos: 
//  id 
//  nombre 
//  apellido 
//  dni (único) 
//  email (único) 
//  fecha_nacimiento 
//  teléfono 
//  dirección 
//  género (enum: masculino, femenino, otro) 
//  activo (boolean, default: true)
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }
}
