<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Place extends Model
{
    use HasFactory;
	protected $fillable = ['name', 'description', 'img'];

	protected static function booted()
    {
        static::deleting(function ($place) {
            Storage::delete(str_replace('/storage/', '/public/', $place->img));
        });
    }
}
