<?php

namespace App\Http\Controllers;

use App\Models\Platillos;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use App\Models\Categorias;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Storage;

class PlatillosController extends Controller
{
    public function index()
    {
        $platillos = Platillos::all();

        return view('platillos.index', compact('platillos'));
    }

    public function generatePDF()
    {   
        $dompdf = new Dompdf();
    
        $platillos = Platillos::all();
        // Convertir imágenes a Base64 y añadirlas al array de platillos
        foreach ($platillos as $platillo) {
            if ($platillo->imagen) {
                $imagePath = public_path('carpeta_imagenes/' . $platillo->imagen);
                $imageBase64 = $this->getImageBase64($imagePath);
                $platillo->imagen = $imageBase64;
            }
        }

        $html = view('platillos.pdf', compact('platillos'))->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        
        $pdfContent = $dompdf->output();
        Storage::disk('public')->put('PDFs/Platillos.pdf', $pdfContent);

        // Devolver el contenido del PDF
        return response($pdfContent)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename="Platillos.pdf"');
    }

    function getImageBase64($imagePath) {
        $imageData = file_get_contents($imagePath);
        $base64 = 'data:image/' . pathinfo($imagePath, PATHINFO_EXTENSION) . ';base64,' . base64_encode($imageData);
        return $base64;
    }



    public function create()
    {
        $categorias = Categorias::all();
        return view('platillos.create', compact('categorias'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:platillos|max:255',
            'categoria_id' => 'required|numeric',
            'precio' => 'required|numeric',
        ]);


        $nombreImagen = null; // Variable para almacenar el nombre de la imagen

        // Guardar la imagen
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '.' . $imagen->getClientOriginalExtension();
            $rutaImagen = public_path('carpeta_imagenes/' . $nombreImagen);

            // Mover la imagen a la carpeta deseada
            $imagen->move(public_path('carpeta_imagenes'), $nombreImagen);
        }

        Platillos::create([
            'name' => $request->name,
            'categoria_id' => $request->categoria_id,
            'precio' => $request->precio,
            'imagen' => $nombreImagen, // Asignar el nombre de la imagen al campo 'imagen'
        ]);

        return redirect()->route('platillos.index')->with('success', 'Platillo creado correctamente');
    }


    public function edit(Platillos $platillo)
    {
        $categorias = Categorias::all();
        return view('platillos.edit', compact('categorias', 'platillo'));
    }

    public function update(Request $request, Platillos $platillo)
    {
        $request->validate([
            'name' => 'required',
            'categoria_id' => 'required|numeric',
            'precio' => 'required|numeric',
        ]);

        // Actualizar la imagen si se proporciona
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '.' . $imagen->getClientOriginalExtension();
            $rutaImagen = public_path('carpeta_imagenes/' . $nombreImagen);

            // Mover la imagen a la carpeta deseada
            $imagen->move(public_path('carpeta_imagenes'), $nombreImagen);

            // Eliminar imagen anterior si existe
            if ($platillo->imagen) {
                // Eliminar la imagen anterior del servidor si ya existe
                $rutaImagenAnterior = public_path('carpeta_imagenes/' . $platillo->imagen);
                if (file_exists($rutaImagenAnterior)) {
                    unlink($rutaImagenAnterior);
                }
            }
        }

        $platillo->update([
            'name' => $request->name,
            'categoria_id' => $request->categoria_id,
            'precio' => $request->precio,
            'imagen' => $nombreImagen,
        ]);

        return redirect()->route('platillos.index')->with('success', '¡El platillo se actualizó correctamente!');
    }

    public function destroy(Platillos $platillo)
    {
        $platillo->delete();

        return redirect()->route('platillos.index')->with('success', 'Platillo eliminado correctamente');

    }
}
