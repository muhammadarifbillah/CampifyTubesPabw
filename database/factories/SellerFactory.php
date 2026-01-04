<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seller>
 */
class SellerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Seller::class;

    public function definition(): array
    {
        return [
            'user_id' => fake()->unique()->bothify('USR###'),
            'store_name' => fake()->company(),
            'owner_name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'store_description' => fake()->paragraph(),
            'status' => 'open',
            'logo' => null,
            'banner' => null,
            'photos' => [],
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'city' => fake()->city(),
            'province' => fake()->state(),
            'postal_code' => fake()->postcode(),
            'open_time' => '08:00:00',
            'close_time' => '22:00:00',
            'operational_days' => 'Senin,Selasa,Rabu,Kamis,Jumat,Sat,Sun',
            'shipping_estimate' => '2-3 hari',
            'slogan' => fake()->catchPhrase(),
            'theme_color' => '#10b981',
            'instagram' => '@' . fake()->userName(),
            'facebook' => fake()->userName(),
            'tiktok' => '@' . fake()->userName(),
            'website' => 'https://' . fake()->domainName(),
        ];
    }
}
