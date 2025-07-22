<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table = 'proyectos';

    protected $fillable = [
        'nombre',
        'fecha_inicio',
        'estado',
        'responsable',
        'monto',
    ];
    
    public const ESTADOS = [
        'Por hacer',
        'En análisis',
        'En planificación',
        'En desarrollo',
        'En pruebas',
        'En espera',
        'Hecho',
        'Cancelado',
    ];
}
