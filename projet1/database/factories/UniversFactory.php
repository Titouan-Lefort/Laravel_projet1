<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Univers;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UniversFactory extends Factory
{



    protected $model = Univers::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName(),
            'description' => $this->faker->text(50),
            'image' => $this->faker->imageUrl(),
            'logo' => $this->faker->imageUrl(),
            'couleur_principale' => $this->faker->hexColor(),
            'couleur_secondaire' => $this->faker->hexColor(),
        ];
    }
}
