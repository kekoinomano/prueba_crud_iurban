<?php

namespace Tests\Feature;

use App\Models\Place;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PlaceTest extends TestCase
{
	use RefreshDatabase, WithFaker;

	public function setUp(): void
	{
		parent::setUp();
		Artisan::call('migrate');
		Storage::fake('public');
	}

	public function testIndexReturnsJsonForApiRequests()
	{
		$response = $this->getJson('/api/places');
		$response->assertStatus(200);
	}

	public function testStoreValidatesInputAndSavesData()
	{
		$file = UploadedFile::fake()->image('place.jpg');

		$data = [
			'name' => 'Place Test',
			'description' => 'A wonderful place',
			'img' => $file
		];

		$response = $this->postJson('/api/places', $data);
		$response->assertStatus(201);

		$place = Place::first();
		$this->assertTrue(Storage::disk('public')->exists('places/' . basename($place->img)), 'Imagen no encontrada en el directorio esperado.');
	}

	public function testStoreFailsWithInvalidInput()
	{
		$data = [
			'name' => '',
			'description' => '',
			'img' => 'not_an_image'
		];

		$response = $this->postJson('/api/places', $data);
		$response->assertStatus(422);
	}

	public function testShowReturnsJsonForApiRequests()
	{
		$place = Place::factory()->create();
		$response = $this->getJson('/api/places/' . $place->id);
		$response->assertStatus(200);
		$response->assertJsonFragment(['name' => $place->name]);
	}

	public function testUpdateWorksCorrectly()
	{
		$place = Place::factory()->create();

		$data = [
			'name' => 'Updated Place',
			'description' => 'Updated description',
			'img' => UploadedFile::fake()->image('updated.jpg')
		];

		$response = $this->putJson('/api/places/' . $place->id, $data);
		$place->refresh();

		$this->assertEquals('Updated Place', $place->name);
		$this->assertEquals('Updated description', $place->description);
		$this->assertTrue(Storage::disk('public')->exists('places/' . basename($place->img)), 'Imagen no encontrada en el directorio esperado.');
	}

	public function testDestroyDeletesRecord()
	{
		$place = Place::factory()->create();

		$response = $this->deleteJson('/api/places/' . $place->id);
		$this->assertDeleted($place);
	}

	public function testUpdateFailsWithInvalidInput()
	{
		$place = Place::factory()->create();

		$data = [
			'name' => '',
			'description' => '',
			'img' => 'not_an_image'
		];

		$response = $this->putJson('/api/places/' . $place->id, $data);
		$response->assertStatus(422);
	}
	public function testShowFailsWithInvalidId()
	{
		// Test with a random ID that does not exist in the database
		$response = $this->getJson('/api/places/9999');
		$response->assertStatus(404);
		$response->assertJson(['message' => 'Punto de interés no encontrado.']);
	}

	public function testUpdateFailsWithInvalidId()
	{
		$data = [
			'name' => 'Updated Place',
			'description' => 'Updated description',
			'img' => UploadedFile::fake()->image('updated.jpg')
		];

		$response = $this->putJson('/api/places/9999', $data);
		$response->assertStatus(404);
		$response->assertJson(['message' => 'Punto de interés no encontrado.']);
	}

	public function testDestroyFailsWithInvalidId()
	{
		$response = $this->deleteJson('/api/places/9999');
		$response->assertStatus(404);
		$response->assertJson(['message' => 'Punto de interés no encontrado.']);
	}

	public function testJsonStructureOnSuccess()
	{
		$place = Place::factory()->create();

		$response = $this->getJson('/api/places/' . $place->id);
		$response->assertStatus(200);
		$response->assertJsonStructure(['id', 'name', 'description', 'img', 'created_at', 'updated_at']);
	}
}
