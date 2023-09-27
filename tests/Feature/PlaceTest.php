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
        $response = $this->getJson('/places');
		//dd($response);
        $response->assertStatus(200);
    }

    public function testIndexReturnsViewForWebRequests()
    {
        $response = $this->get('/places');
        $response->assertStatus(200);
        $response->assertViewIs('places.index');
    }

	public function testStoreValidatesInputAndSavesData()
	{
		$file = UploadedFile::fake()->image('place.jpg');
		
		$data = [
			'name' => 'Place Test',
			'description' => 'A wonderful place',
			'img' => $file
		];
		
		$response = $this->post('/places', $data);
		$response->assertStatus(302);
		
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

        $response = $this->post('/places', $data);
        $response->assertSessionHasErrors(['name', 'description', 'img']);
    }

    public function testShowReturnsJsonForApiRequests()
    {
        $place = \App\Models\Place::factory()->create();

        $response = $this->getJson(route('places.show', $place));
        $response->assertStatus(200);
        $response->assertJsonFragment(['name' => $place->name]);
    }

    public function testShowReturnsViewForWebRequests()
    {
        $place = \App\Models\Place::factory()->create();

        $response = $this->get(route('places.show', $place));
        $response->assertStatus(200);
        $response->assertViewIs('places.show');
    }

    public function testUpdateWorksCorrectly()
    {
        $place = \App\Models\Place::factory()->create();

        $data = [
            'name' => 'Updated Place',
            'description' => 'Updated description',
            'img' => UploadedFile::fake()->image('updated.jpg')
        ];

        $response = $this->put(route('places.update', $place), $data);
        $place->refresh();

        $this->assertEquals('Updated Place', $place->name);
        $this->assertEquals('Updated description', $place->description);
		$this->assertTrue(Storage::disk('public')->exists('places/' . basename($place->img)), 'Imagen no encontrada en el directorio esperado.');

    }

    public function testDestroyDeletesRecord()
    {
        $place = \App\Models\Place::factory()->create();

        $response = $this->delete(route('places.destroy', $place));
        $this->assertDeleted($place);
    }

    public function testUpdateFailsWithInvalidInput()
    {
        $place = \App\Models\Place::factory()->create();

        $data = [
            'name' => '',
            'description' => '',
            'img' => 'not_an_image'
        ];

        $response = $this->put(route('places.update', $place), $data);
        $response->assertSessionHasErrors(['name', 'description', 'img']);
    }
}
