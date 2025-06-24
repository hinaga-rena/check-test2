<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(), // 商品名（1語のダミー）
            'price' => $this->faker->numberBetween(600, 1400), // 600〜1400円のランダム価格
            'image' => $this->faker->randomElement([
                'banana.png',
                'grapes.png',
                'kiwi.png',
                'lemon.png',
                'muscat.png',
                'orange.png',
                'peach.png',
                'pineapple.png',
                'strawberry.png',
                'watermelon.png',
            ]),
            'description' => $this->faker->sentence(), // 短い説明文（1文）
        ];
    }
}
