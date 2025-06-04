<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TAKSubmission>
 */
class TAKSubmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'activity_name' => $this->faker->sentence(3),
            'category' => $this->faker->randomElement(['Organisasi', 'Seminar', 'Lomba']),
            'level' => $this->faker->randomElement(['Peserta', 'Panitia', 'Ketua']),
            'activity_date' => $this->faker->date(),
            'file_path' => null,
            'approval_status_id' => 1,
        ];
    }
}
