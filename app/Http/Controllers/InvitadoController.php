<?php

namespace App\Http\Controllers;

use App\Models\Invitado;
use Illuminate\Http\Request;

class InvitadoController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required',
                'estatus' => 'required',
                'tipo' => 'required|in:novio,novia',
                'principal' => 'required|boolean',
                'folio_id' => 'required|exists:folios,id',
            ]);

            // Asegurar que solo haya un invitado principal por folio
            if ($request->principal) {
                Invitado::where('folio_id', $request->folio_id)
                    ->where('principal', true)
                    ->update(['principal' => false]);
            }

            $invitado = Invitado::create($request->all());

            return response()->json($invitado, 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear el invitado: '], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $invitado = Invitado::findOrFail($id);

            $request->validate([
                'estatus' => 'required',
            ]);

            $invitado->update($request->all());

            return response()->json($invitado);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Invitado no encontrado'], 404);
        } catch (ValidationException $e) {
            return response()->json(['error' => 'Error al actualizar el invitado'], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar el invitado'], 500);
        }
    }

    public function getPrincipal($folio_id)
    {
        try {
            $invitado = Invitado::where('folio_id', $folio_id)
                ->where('principal', true)
                ->firstOrFail();

            return response()->json($invitado);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Invitado principal no encontrado'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener el invitado principal'], 500);
        }
    }
}