<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    protected $model = Student::class;
    // With this factory, we can create student instances with random data for testing purposes. So clearly the names will not sound as argentinian :b
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'dni' => $this->faker->unique()->numerify('########'),
            'email' => $this->faker->unique()->safeEmail,
            'birth_date' => $this->faker->date('Y-m-d', '-16 years'),
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'active' => true,
        ];
    }
}