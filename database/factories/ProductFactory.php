<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'price' => rand(50,10000),
            'stock' => rand(1,150),
            'color' => $this->faker->name(),
            'category_id' => Category::all()->random()->id,
            'brand_id' => Brand::all()->random()->id,
            'detail' => $this->faker->paragraph(),
        ];
    }
}
