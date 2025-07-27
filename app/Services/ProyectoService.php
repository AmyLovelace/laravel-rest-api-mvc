<?php

namespace App\Services;

use App\Models\Proyecto;
use Illuminate\Support\Facades\Http;

class ProyectoService
{
    public function listar()
    {
        return Proyecto::all();
    }

    public function obtener($id)
    {
        return Proyecto::findOrFail($id);
    }

    public function crear(array $data)
    {
        return Proyecto::create($data);
    }

    public function actualizar($id, array $data)
    {
        $proyecto = Proyecto::findOrFail($id);
        $proyecto->update($data);
        return $proyecto;
    }

    public function eliminar($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $proyecto->delete();
    }

    public function existe($id)
    {
        return Proyecto::find($id) !== null;
    }

    public function obtenerUf()
    {
        try {
            $response = Http::get('https://mindicador.cl/api/uf');
            return $response->json()['serie'][0]['valor'] ?? null;
        } catch (\Exception $e) {
            return null;
        }
    }
}
