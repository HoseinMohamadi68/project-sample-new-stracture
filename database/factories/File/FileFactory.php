<?php

namespace Database\Factories\File;

use App\Models\File\File;
use App\Models\File\RootFile;
use Illuminate\Database\Eloquent\Factories\Factory;

class FileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = File::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            File::ROOT_FILE_ID => RootFile::factory()->create()->getId(),
            File::NAME => $this->faker->name,
            File::ENABLED => $this->faker->boolean,
            File::EXTENSION => $this->faker->fileExtension,
        ];
    }
}
