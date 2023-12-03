<?php

namespace App\Http\Controllers;

use App\Models\Ingredientes;
use App\Models\Postres;
use App\Models\PostresDetalles;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function show($id)
    {
        $postre = Postres::find($id);
        $ingredientes = Ingredientes::all();

        return view('postres.show', compact('postre', 'ingredientes'));
    }

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

   
    public function generatePDF()
    {   
        $dompdf = new Dompdf();
        
        $postres = Postres::all();

        foreach ($postres as $postre) {
            if ($postre->imagen) {
                $imagePath = public_path('imagenes_postres/' . $postre->imagen);
                $imageBase64 = $this->getImageBase64($imagePath);
                $postre->imagen = $imageBase64;
            }
        }

        $html = view('postres.pdf', compact('postres'))->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        
        $pdfContent = $dompdf->output();
        Storage::disk('public')->put('PDFs/Postres.pdf', $pdfContent);

        return response()->file(Storage::disk('public')->path('PDFs/Postres.pdf'));
    }

    function getImageBase64($imagePath) {
        $imageData = file_get_contents($imagePath);
        $base64 = 'data:image/' . pathinfo($imagePath, PATHINFO_EXTENSION) . ';base64,' . base64_encode($imageData);
        return $base64;
    }

    public function agregarIngrediente(Postres $postre, Ingredientes $ingrediente)
    {
        // Verificar si ya existe el detalle para evitar duplicados
        $detalleExistente = PostresDetalles::where('postre_id', $postre->id)
            ->where('ingrediente_id', $ingrediente->id)
            ->first();

        // Si no existe el detalle, crear uno nuevo
        if (!$detalleExistente) {
            $PostresDetalles = PostresDetalles::create([
                'postre_id' => $postre->id,
                'ingrediente_id' => $ingrediente->id,
            ]);
        }

        return redirect()->back()->with('success', 'Ingrediente agregado al postre correctamente.');
    }

    public function borrar($postre_id, $ingrediente_id)
    {
        // Buscar el detalle específico basado en los IDs proporcionados
        $detalle = PostresDetalles::where('postre_id', $postre_id)
                                ->where('ingrediente_id', $ingrediente_id)
                                ->first();

        // Verificar si se encontró el detalle y eliminarlo si existe
        if ($detalle) {
            $detalle->delete();
            return redirect()->back()->with('success', 'Detalle del ingrediente eliminado correctamente');
        }

        // Manejar el caso en el que no se encontró el detalle
        return redirect()->back()->with('error', 'No se encontró el detalle del ingrediente');
    }
    
    public function destroy(Postres $postre)
    {
        $postre->delete();

        return redirect()->route('postres.index')->with('success', 'Postre eliminado correctamente');
    }
}
