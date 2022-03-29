<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $age = $this->faker->numberBetween(18, 59);
        $month = $this->faker->numberBetween(1, 12);
        $day = $this->faker->numberBetween(1, 30);
        $genre = ["homme", "femme"];
        return [
            'nom' => $this->faker->firstName(),
            'prenom' => $this->faker->lastName(),
            'age' => $age,
            'email' => $this->faker->unique()->safeEmail(),
            'mdp' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'ddn' => (2022 - $age) . "-" . ($month < 10 ? "0".$month : $month). "-" . ($day < 10 ? "0".$day : $day),
            'genre' => $genre[$this->faker->numberBetween(0, 1)],
            'role_id' => $this->faker->numberBetween(1, count(Role::all())),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
