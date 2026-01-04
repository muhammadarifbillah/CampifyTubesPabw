<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Buyer;
use App\Models\Seller;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        // Create some sellers and corresponding user accounts
        // Ensure admin user exists
        $admin = User::firstOrCreate([
            'email' => 'admin@example.com'
        ], [
            'name' => 'Admin User',
            'role' => 'admin',
            'password' => Hash::make('password')
        ]);
        $this->command->info('Admin user ensured: ' . $admin->email);



        $sellers = Seller::factory()->count(3)->create();
        $this->command->info('Sellers created: ' . $sellers->count());
        foreach ($sellers as $seller) {
            User::factory()->create([
                'name' => $seller->owner_name,
                'email' => $seller->email,
                'role' => 'seller',
                'password' => Hash::make('password'),
            ]);
        }

        // Create buyers
        $buyers = Buyer::factory()->count(10)->create();
        $this->command->info('Buyers created: ' . $buyers->count());

        // Optionally create a test buyer user
        $testBuyer = User::factory()->create([
            'name' => 'Buyer User',
            'email' => 'buyer@example.com',
            'role' => 'buyer',
            'password' => Hash::make('password'),
        ]);
        $this->command->info('Test buyer user created: ' . $testBuyer->email);

    }
}
