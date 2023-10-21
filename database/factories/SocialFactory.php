<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Social>
 */
class SocialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    // protected $model = \App\Models\Social::class;

    private $selectedUsers = [];

    public function definition(): array
    {
        $user = \App\Models\User::inRandomOrder()
            ->whereNotIn('id', $this->selectedUsers)
            ->first();

        if ($user) {
            $this->selectedUsers[] = $user->id;
            return [
                'user_id' => $user->id,
                'website' => "website$user->id.com",
                'facebook' => "fb$user->id",
                'instagram' => "insta$user->id",
                'linkedin' => "linkdin$user->id",
                'pinterest' => "pinterest$user->id",
            ];
        } else {
            // Handle the case where there are not enough unique suppliers users.
            return [];
        }
    }
}
