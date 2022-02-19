<?php

namespace Database\Factories\File;

use App\Models\File\RootFile;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

class RootFileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RootFile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $file = UploadedFile::fake()->image($this->faker->name . '.png');
        $random = $this->faker->numberBetween(1, 1000000000000);

        return [
            RootFile::SIZE => $this->faker->numberBetween(100, 100000),
            RootFile::MIME_TYPE => $file->getMimeType(),
            RootFile::CONTENT_HASH => sha1_file($file) . $random,
            RootFile::SYNCED => $this->faker->boolean,
            RootFile::PATH => sha1_file($file) . $random . '.' . $file->getClientOriginalExtension(),
        ];
    }
}
