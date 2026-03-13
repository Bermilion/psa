<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => fake()->name(),
            'position' => fake()->jobTitle(),
            'specialty' => fake()->word(),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'passport' => fake()->regexify('[A-Z]{2}\d{7}'),
            'snils' => fake()->regexify('\d{3}-\d{3}-\d{3} \d{2}'),
            'inn' => fake()->regexify('\d{12}'),
            'employment_date' => fake()->date(),
            'notes' => fake()->text(200),
            'user_id' => null
        ];
    }
}
