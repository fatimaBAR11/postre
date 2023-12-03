<?php

namespace App\Http\Controllers;

use App\Models\Ingredientes;
use Illuminate\Http\Request;

class IngredientesController extends Controller
{
    public function index()
    {
        $ingredientes = Ingredientes::all();
        return view('ingredientes.index', compact('ingredientes'));
    }

    public function create()
    {
        return view('ingredientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:ingredientes|max:255',
        ]);

        Ingredientes::create([
            'name' => $request->name,
        ]);

        return redirect()->route('ingredientes.index')->with('success', 'Ingrediente creado correctamente');
    }

    public function edit(Ingredientes $ingrediente)
    {
        return view('ingredientes.edit', compact('ingrediente'));
    }

    public function update(Request $request, Ingredientes $ingrediente)
    {
        $request->validate([
            'name' => 'required|unique:ingredientes,name,' . $ingrediente->id . '|max:255',
        ]);

        $ingrediente->update([
            'name' => $request->name,
        ]);

        return redirect()->route('ingredientes.index')->with('success', 'Ingrediente actualizado correctamente');
    }

    public function destroy(Ingredientes $ingrediente)
    {
        $ingrediente->delete();

        return redirect()->route('ingredientes.index')->with('success', 'Ingrediente eliminado correctamente');
    }
}
