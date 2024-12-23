<?php

namespace Database\Factories;

use App\Models\InventoryGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

class InventoryGroupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InventoryGroup::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        'required_permission' => $this->faker->word,
        'status' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'created_by' => $this->faker->word,
        'updated_by' => $this->faker->word,
        'deleted_by' => $this->faker->word
        ];
    }
}
