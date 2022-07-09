<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class;

    public function definition()
    {
        return [
            'title'=>$this->faker->text(30),
            'description'=>$this->faker->text(),
            'image'=>$this->faker->imageUrl(),
            'price'=>$this->faker->numberBetween(10,100)
        ];
    }
}
