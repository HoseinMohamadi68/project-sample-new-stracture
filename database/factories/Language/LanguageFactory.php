<?php

namespace Database\Factories\Language;

use App\Models\Language\Language;
use File;
use Illuminate\Database\Eloquent\Factories\Factory;

class LanguageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Language::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $json = File::get("storage/seederFiles/languages.json");
        $data = json_decode($json, true);
        $randomItem = rand(0, count($data) - 1);

        return [
            Language::TITLE => $data[$randomItem][Language::TITLE],
            Language::ALPHA2 => $data[$randomItem][Language::ALPHA2],
            Language::IS_LTR => $this->faker->boolean,
        ];
    }
}
