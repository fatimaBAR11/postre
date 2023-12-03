<?php

namespace App\Http\Controllers;

use App\Models\Postres;
use Illuminate\Http\Request;

class PostresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postres = Postres::all();
        return view('postres.index', compact('postres'));
    }


    public function create()
    {
        return view('postres.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:postres|max:255',
            'preparacion' => 'required|string',
        ]);

        $nombreImagen = null; // Variable para almacenar el nombre de la imagen

        // Guardar la imagen
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '.' . $imagen->getClientOriginalExtension();
            $rutaImagen = public_path('imagenes_postres/' . $nombreImagen);

            // Mover la imagen a la carpeta deseada
            $imagen->move(public_path('imagenes_postres'), $nombreImagen);
        }

        Postres::create([
            'nombre' => $request->nombre,
            'preparacion' => $request->preparacion,
            'imagen' => $nombreImagen, // Asignar el nombre de la imagen al campo 'imagen'
        ]);

        return redirect()->route('postres.index')->with('success', 'Postre creado correctamente');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Postres $postre)
    {
        return view('postres.edit', compact('postre'));
    }
    public function update(Request $request, Postres $postre)
    {
        $request->validate([
            'nombre' => 'required|max:255|unique:postres,nombre,' . $postre->id,
            'preparacion' => 'required|string',
        ]);

        $nombreImagen = $postre->imagen;

        // Actualizar la imagen si se proporciona
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '.' . $imagen->getClientOriginalExtension();
            $rutaImagen = public_path('imagenes_postres/' . $nombreImagen);

            // Mover la imagen a la carpeta deseada
            $imagen->move(public_path('imagenes_postres'), $nombreImagen);

            // Eliminar imagen anterior si existe
            if ($postre->imagen) {
                // Eliminar la imagen anterior del servidor si ya existe
                $rutaImagenAnterior = public_path('imagenes_postres/' . $postre->imagen);
                if (file_exists($rutaImagenAnterior)) {
                    unlink($rutaImagenAnterior);
                }
            }
        }

        // Actualizar el postre sin cambiar la imagen si no se proporciona ninguna nueva
        $postre->update([
            'nombre' => $request->nombre,
            'preparacion' => $request->preparacion,
            'imagen' => $nombreImagen, // Asignar el nombre de la imagen al campo 'imagen'
        ]);

        return redirect()->route('postres.index')->with('success', '¡El postre se actualizó correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
