<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TareaController extends Controller
{
    // Mostrar lista de tareas
    public function index()
    {
        $tareas = Tarea::where('user_id', Auth::id()) // Solo las del usuario logueado
            ->orderBy('completada', 'asc') // Pendientes primero
            ->orderBy('fecha_limite', 'asc') // Luego por fecha
            ->get();

        return view('tareas.index', compact('tareas'));
    }

    // Guardar nueva tarea
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'fecha_limite' => 'required|date',
            'prioridad' => 'required|integer'
        ]);

        Tarea::create([
            'titulo' => $request->titulo,
            'fecha_limite' => $request->fecha_limite,
            'prioridad' => $request->prioridad,
            'user_id' => Auth::id(), // Asignamos la tarea al usuario actual
            'categoria' => 'General'
        ]);

        return redirect()->back();
    }

    // Marcar como completada/pendiente (El botón mágico)
    public function toggle(Tarea $tarea)
    {
        if ($tarea->user_id !== Auth::id()) abort(403); // Seguridad

        $tarea->completada = !$tarea->completada;
        $tarea->save();

        return redirect()->back();
    }

    // Eliminar tarea
    public function destroy(Tarea $tarea)
    {
        if ($tarea->user_id !== Auth::id()) abort(403);

        $tarea->delete();
        return redirect()->back();
    }
    // Muestra el formulario de edición
    public function edit(Tarea $tarea)
    {
        // Seguridad: Solo el dueño puede editar
        if ($tarea->user_id !== Auth::id()) abort(403);

        return view('tareas.edit', compact('tarea'));
    }

    // Guarda los cambios en la base de datos
    public function update(Request $request, Tarea $tarea)
    {
        if ($tarea->user_id !== Auth::id()) abort(403);

        $request->validate([
            'titulo' => 'required|string|max:255',
            'fecha_limite' => 'required|date',
            'prioridad' => 'required|integer'
        ]);

        $tarea->update($request->all());

        // Redirigimos a la lista con un mensaje de éxito
        return redirect()->route('tareas.index')->with('success', 'Tarea actualizada correctamente.');
    }
}
