<?php

namespace Database\Factories;

use App\Models\Company;
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
        $c = Company::inRandomOrder()->first()->id;
        return [
            'first_name' => $this->faker->firstName($gender = 'male'|'female'),
            'last_name' => $this->faker->lastName,
            'company_id' => $c,
            'email' => $this->faker->freeEmail,
            'phone' => $this->faker->e164PhoneNumber,
        ];
    }
}
