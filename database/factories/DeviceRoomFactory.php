<?php

namespace Database\Factories;

use App\Models\DeviceRoom;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeviceRoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DeviceRoom::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'antenna' => $this->faker->word,
        'room_id' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'created_by' => $this->faker->word,
        'updated_by' => $this->faker->word,
        'deleted_by' => $this->faker->word
        ];
    }
}
