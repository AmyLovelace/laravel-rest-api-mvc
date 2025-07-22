<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;


use Illuminate\Http\Request;
use App\Models\Proyecto;

class ProyectoController extends Controller
{
    /**
     * Listar todos los proyectos.
     */
    public function showAll()
    {
        return response()->json(Proyecto::all());
    }

    /**
     * Agregar Proyecto.
     */
    public function store(Request $request)
    {
        // Validación simple
        $request->validate([
            'nombre' => 'required|string',
            'estado' => 'required|string',
            'fecha_inicio' => 'required|date',
            'responsable' => 'required|string',
            'monto' => 'required|integer',
        ]);

        $proyecto = Proyecto::create($request->only(['nombre', 'estado', 'fecha_inicio', 'responsable', 'monto']));

        // return response()->json([
        //     'message' => 'Proyecto creado',
        //     'data' => $proyecto
        // ], 201);
        return redirect('/proyectos/create')->with('success', 'Proyecto creado exitosamente');
    }

    /**
     * Obtener un proyecto por su id.
     */
    public function show($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        return view('proyectos.show', compact('proyecto'));
    }

    /**
     * Actualizar proyecto por su id.
     */
    public function update(Request $request, $id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $proyecto->update($request->only(['nombre', 'estado', 'fecha_inicio', 'responsable', 'monto']));

        // return response()->json([
        //     'message' => 'Proyecto actualizado',
        //     'data' => $proyecto
        // ]);
        return redirect()->route('proyectos.edit', $proyecto->id)
        ->with('success', 'Proyecto actualizado con éxito');
    }


    public function edit($id)
{
    $proyecto = Proyecto::findOrFail($id);
    return view('proyectos.edit', compact('proyecto'));
}


    /**
     * Eliminar proyecto por su Id.
     */
    public function destroy($id)
{
    $proyecto = Proyecto::findOrFail($id);
    $proyecto->delete();

    return redirect()->route('proyectos.panel')->with('success', 'Proyecto eliminado correctamente');
}

    public function create()
    {
        return view('proyectos.create');
    }

    public function index()
        {
            $proyectos = Proyecto::all();
            return view('proyectos.index', compact('proyectos'));
        }


 

        public function panel()
        {
            try {
                $response = Http::get('https://mindicador.cl/api/uf');
                $data = $response->json();
        
                $uf = null;
                if (!empty($data['serie']) && isset($data['serie'][0]['valor'])) {
                    $uf = $data['serie'][0]['valor'];
                }
            } catch (\Exception $e) {
                $uf = null;
            }
        
            $proyectos = Proyecto::all(); 
        
            return view('proyectos.panel', compact('proyectos', 'uf'));
        }

        public function buscar(Request $request)
        {
            $id = $request->input('id');

            if (!$id) {
                return redirect()->route('proyectos.panel')->withErrors(['id' => 'Debes ingresar un ID']);
            }

            // Opcional: verificar si el proyecto existe
            if (!Proyecto::find($id)) {
                return redirect()->route('proyectos.panel')->withErrors(['id' => 'No existe un proyecto con ese ID']);
            }

            return redirect()->route('proyectos.show', ['id' => $id]);
        }

}
          