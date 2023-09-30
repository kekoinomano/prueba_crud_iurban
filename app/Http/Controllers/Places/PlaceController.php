<?php

namespace App\Http\Controllers\Places;


use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends BasePlaceController
{
    public function index()
    {
        $places = Place::paginate(5);
        return view('places.index', compact('places'));
    }

    public function create()
    {
        return view('places.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateRequest($request);
        $place = Place::create($data);
        return redirect()->route('places.index')->with('success', 'Punto creado exitosamente');
    }

    public function show($id)
    {
        $place = Place::findOrFail($id);
        return view('places.show', compact('place'));
    }

    public function edit($id)
    {
        $place = Place::findOrFail($id);
        return view('places.edit', compact('place'));
    }

    public function update(Request $request, $id)
    {
		$place = Place::findOrFail($id);
        $data = $this->validateRequest($request, true, $place);
        $place->update($data);
        return redirect()->route('places.show', $id)->with('success', 'Punto de interés actualizado con éxito.');
    }

    public function destroy($id)
    {
        $place = Place::findOrFail($id);
        $place->delete();
        return redirect()->route('places.index')->with('success', 'Punto de interés eliminado con éxito.');
    }

}