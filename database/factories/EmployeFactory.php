<?php

namespace Database\Factories;

use App\Models\Employe;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employe::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName($gender = 'male'|'female'),
            'last_name' => $this->faker->lastName,
            'company_id' => $this->faker->numberBetween($min = 1, $max = 10),
            'email' => $this->faker->freeEmail,
            'phone' => $this->faker->e164PhoneNumber,
        ];
    }
}
