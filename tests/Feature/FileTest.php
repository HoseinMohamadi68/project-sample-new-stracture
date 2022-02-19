<?php

namespace Tests\Feature;

use App\Constants\PermissionTitle;
use App\Models\File\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FileTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * @test
     */
    public function userCanCreateFile()
    {
        $this->withExceptionHandling();
        Storage::fake('public');
        $file = UploadedFile::fake()->image('test-file.csv');
        $this->actingAsUserWithPermission(PermissionTitle::CREATE_FILE);
        $response = $this->postJson(route('files.store'), ['file' => $file])->assertCreated();
        Storage::disk('public')->assertExists(sha1_file($file) . '.csv');
        $this->assertEquals($response->getOriginalContent()->getExtension(), 'csv');
        $this->assertEquals($response->getOriginalContent()->getName(), 'test-file.csv');
        $this->assertEquals($response->getOriginalContent()->rootFile->getContentHash(), sha1_file($file));
    }

    /**
     * @test
     */
    public function userWithoutPermissionCanNotCreateFile()
    {
        $file = UploadedFile::fake()->image('test-file.csv');
        $this->actingAsUser();
        $this->postJson(route('files.store'), ['file' => $file])->assertForbidden();
    }

    /**
     * @test
     */
    public function userWithoutLoginCanNotCreateFile()
    {
        $file = UploadedFile::fake()->image('test-file.csv');
        $this->postJson(route('files.store'), ['file' => $file])->assertUnauthorized();
    }

    /**
     * @test
     */
    public function userCanGetFile()
    {
        $file = File::factory()->create();
        $this->actingAsUserWithPermission(PermissionTitle::GET_FILE);
        $response = $this->getJson(route('files.show', $file))->assertOk();
        $this->assertEquals($response->getOriginalContent()->getId(), $file->getId());
    }

    /**
     * @test
     */
    public function userWithoutPermissionCanNotGetFile()
    {
        $file = File::factory()->create();
        $this->actingAsUser();
        $this->getJson(route('files.show', $file))->assertForbidden();
    }

    /**
     * @test
     */
    public function userWithoutLoginCanNotGetFile()
    {
        $file = File::factory()->create();
        $this->getJson(route('files.show', $file))->assertUnauthorized();
    }
}
