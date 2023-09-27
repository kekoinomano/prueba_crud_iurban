<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $places = Place::paginate(5);

		//Vista API
		if ($request->expectsJson()) {
            return response()->json($places);
        }
		//Vista Blade
        return view('places.index', compact('places'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('places.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
			'name' => 'required|string|max:255',
			'description' => 'required|string',
			'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
		]);
		if ($request->hasFile('img')) {
			$imageName = time().'.'.$request->img->extension(); 
			$path = $request->img->storeAs('places', $imageName, 'public');
			//$data['img'] = '/storage/places/' . $imageName;
			$data['img'] = Storage::url($path);
		}
		
		

        $place = Place::create($data);
		//Vista API
		if ($request->expectsJson()) {
            return response()->json(['message' => 'Punto creado exitosamente', 'place' => $place], 201);
        }
		//Vista Blade
        return redirect()->route('places.index')->with('success', 'Punto creado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
	 * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function show(Request $request, $id)
	{
		$place = Place::findOrFail($id);
		//Vista API
		if ($request->expectsJson()) {
			return response()->json($place);
		}
		//Vista Blade
		return view('places.show', compact('place'));
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
	{
		$place = Place::findOrFail($id);
		return view('places.edit', compact('place'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function update(Request $request, $id)
	{
		$data = $request->validate([
			'name' => 'required|string|max:255',
			'description' => 'required|string',
			'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
		]);

		$place = Place::findOrFail($id);

		if ($request->hasFile('img')) {
			$imageName = time().'.'.$request->img->extension(); 
			$path = $request->img->storeAs('places', $imageName, 'public');
			//$data['img'] = '/storage/places/' . $imageName;
			$data['img'] = Storage::url($path);
			// Si había una imagen anterior, se elimina
			$oldImage = $place->img;
			if($oldImage) {
				if(file_exists(public_path($oldImage))) {
					unlink(public_path($oldImage));
				}
			}
		}


		$place->update($data);
		
		//Vista API
		if ($request->expectsJson()) {
            return response()->json(['message' => 'Punto de interés actualizado con éxito.', 'place' => $place]);
        }
		//Vista blade
		return redirect()->route('places.show', $id)->with('success', 'Punto de interés actualizado con éxito.');
	}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function destroy(Request $request, $id)
	{
		$place = Place::findOrFail($id);
		$place->delete();

		//Vista API
		if ($request->expectsJson()) {
            return response()->json(['message' => 'Punto de interés eliminado con éxito.']);
        }
		//Vista Blade
		return redirect()->route('places.index')->with('success', 'Punto de interés eliminado con éxito.');
	}
}
