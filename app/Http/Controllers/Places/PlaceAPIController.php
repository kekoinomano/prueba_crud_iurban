<?php

namespace App\Http\Controllers\Places;


use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PlaceAPIController extends BasePlaceController
{
    public function index()
    {
        $places = Place::all();
        return response()->json($places);
    }

    public function store(Request $request)
    {
		try {
			$data = $this->validateRequest($request);
			$place = Place::create($data);
			return response()->json(['message' => 'Punto creado exitosamente', 'place' => $place], 201);
		} catch (ValidationException $e) {
			return response()->json(['errors' => $e->validator->errors()], 422);
		}
	}

    public function show($id)
    {
        $place = Place::find($id);
        if (!$place) {
            return response()->json(['message' => 'Punto de interés no encontrado.'], 404);
        }
        return response()->json($place);
    }

    public function update(Request $request, $id)
    {
		try{

			$place = Place::find($id);
			if (!$place) {
				return response()->json(['message' => 'Punto de interés no encontrado.'], 404);
			}

			$data = $this->validateRequest($request, true, $place);

			$place->update($data);
			return response()->json(['message' => 'Punto de interés actualizado con éxito.', 'place' => $place]);
		} catch (ValidationException $e) {
			return response()->json(['errors' => $e->validator->errors()], 422);
		}
    }

    public function destroy($id)
    {
        $place = Place::find($id);
        if (!$place) {
            return response()->json(['message' => 'Punto de interés no encontrado.'], 404);
        }
        $place->delete();
        return response()->json(['message' => 'Punto de interés eliminado con éxito.']);
    }



}
