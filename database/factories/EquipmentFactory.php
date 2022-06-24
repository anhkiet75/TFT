<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Database\Factories\Helpers\FactoryHelper;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipment>
 */
class EquipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'status' => 'In-use',
            'description' => $this->faker->text(),
            'user_id'  => FactoryHelper::getRandomModelId(User::class),
            'category_id'  => FactoryHelper::getRandomModelId(Category::class),
        ];
    }
}
