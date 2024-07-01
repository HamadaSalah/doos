<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Transaction;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(CarsSeeder::class);
        $this->call(AboutSeeder::class);
        $this->call(BannerSeeder::class);
        $this->call(NotificationSeeder::class);
        $this->call(Transaction::class);

        // $this->call(CategorySeeder::class);
        // $this->call(EmployeeSeeder::class);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
