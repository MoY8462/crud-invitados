<?php

namespace App\Http\Controllers;

use App\Models\Folio;
use Illuminate\Http\Request;

class FolioController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'numero_folio' => 'required|unique:folios,numero_folio',
            ]);

            $folio = Folio::create($request->all());

            return response()->json($folio, 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear el folio'], 500);
        }
    }

    public function show($numero_folio)
    {
        try {
            $folio = Folio::with('invitados')->where('numero_folio', $numero_folio)->firstOrFail();

            return response()->json($folio);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Folio no encontrado'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener el folio'], 500);
        }
    }
}

