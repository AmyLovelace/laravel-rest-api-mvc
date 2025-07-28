<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;


use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Services\ProyectoService;

class ProyectoController extends Controller
{
    protected $proyectos;

    public function __construct(ProyectoService $proyectos)
    {
        $this->proyectos = $proyectos;
    }

    public function index()
    {
        $proyectos = Proyecto::all();
        return view('proyectos.index', compact('proyectos'));
    }

    public function show(Request $request, $id)
    {
        $proyecto = $this->proyectos->obtener($id);

        return $request->wantsJson()
            ? response()->json($proyecto)
            : view('proyectos.show', compact('proyecto'));
    }


            public function create()
            {
                return view('proyectos.create');
            }

public function store(Request $request)
{
    $validated = $request->validate([
        'nombre' => 'required|string',
        'estado' => 'required|string',
        'fecha_inicio' => 'required|date',
        'responsable' => 'required|string',
        'monto' => 'required|integer',
    ]);

    $proyecto = $this->proyectos->crear($validated);

    return $request->wantsJson()
        ? response()->json(['message' => 'Proyecto creado', 'data' => $proyecto], 201)
        : redirect()->route('proyectos.create')->with('success', 'Proyecto creado exitosamente');
}


    public function showAll()
    {
        return response()->json(Proyecto::all());
    }

    public function edit($id)
    {
        $proyecto = $this->proyectos->obtener($id);
        return view('proyectos.edit', compact('proyecto'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre' => 'required|string',
            'estado' => 'required|string',
            'fecha_inicio' => 'required|date',
            'responsable' => 'required|string',
            'monto' => 'required|integer',
        ]);

        $proyecto = $this->proyectos->actualizar($id, $validated);

        return $request->wantsJson()
            ? response()->json(['message' => 'Proyecto actualizado', 'data' => $proyecto])
            : redirect()->route('proyectos.edit', $id)->with('success', 'Proyecto actualizado con éxito');
    }

    public function destroy(Request $request, $id)
    {
        $this->proyectos->eliminar($id);

        return $request->wantsJson()
            ? response()->json(['message' => 'Proyecto eliminado'])
            : redirect()->route('proyectos.panel')->with('success', 'Proyecto eliminado correctamente');
    }

    public function panel()
    {
        $proyectos = $this->proyectos->listar();
        $uf = $this->proyectos->obtenerUf();
        return view('proyectos.panel', compact('proyectos', 'uf'));
    }
    
    public function buscar(Request $request)
    {
        $id = $request->input('id');
        $proyecto = Proyecto::find($id);
    
        if (!$proyecto) {
            if ($request->expectsJson()) {
                return response()->json([
                    'error' => true,
                    'message' => "No se encontró ningún proyecto con ID $id."
                ], 404);
            }
    
            if (!$proyecto) {
                return view('proyectos.show', [
                    'proyecto' => null,
                    'error' => "No se encontró ningún proyecto con ID $id."
                ]);
            }
        }
    
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'proyecto' => $proyecto
            ]);
        }
    
        return redirect()->route('proyectos.show', $proyecto->id);
    }
    

    
}
          