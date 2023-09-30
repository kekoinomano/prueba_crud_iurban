<?php

namespace App\Http\Controllers\Places;

use App\Http\Controllers\Controller;

use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BasePlaceController extends Controller
{
	protected function validateRequest($request, $isUpdate = false, $existingPlace = null)
	{
		$rules = [
			'name' => 'required|string|max:255',
			'description' => 'required|string',
		];

		if (!$isUpdate) {
			$rules['img'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
		} else {
			$rules['img'] = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';
		}

		$data = $request->validate($rules);

		if ($request->hasFile('img')) {
			if ($isUpdate && $existingPlace && $existingPlace->img) {
				// Borrar la imagen anterior
				Storage::delete(str_replace('/storage/', '/public/', $existingPlace->img));
			}
			$imageName = time() . '.' . $request->img->extension();
			$path = $request->img->storeAs('places', $imageName, 'public');
			$data['img'] = Storage::url($path);
		}

		return $data;
	}
}
