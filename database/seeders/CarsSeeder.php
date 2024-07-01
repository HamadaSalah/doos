<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Branch;
use App\Models\Car;
use App\Models\Company;
use App\Models\Recepeit;
use App\Models\RentType;
use App\Models\ReturnPolicy;
use App\Models\ReturnType;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class CarsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Admin::create([
            'name' => 'doos',
            'email' => 'doos@doos.com',
            'password' => Hash::make('doos123')
        ]);

        User::create([
            'name' => 'Hamada Salah',
            'email' => 'emaisl@email.com',
            'phone' => '+201124928780',
            'password' => Hash::make('doos123')
        ]);
        //companies
        Company::create([
            'name' => 'العالمي لتاجير السيارات',
            'img'  => 'company1.png'
        ]);
        Branch::create([
            'name' => 'فرع الدمام',
        ]);

        //renttypes

        $rent1 = RentType::create([
            'name' => 'يومي / أسبوعي',
        ]);

        $rent2 = RentType::create([
            'name' => 'شهري / سنوي',
        ]);
        
        RentType::create([
            'name' => 'الأخذ من المطار',
        ]);

        //recepeit types
        Recepeit::create([
            'name' => 'توصيل إلى موقعي',
        ]);
        Recepeit::create([
            'name' => 'استلام من الفرع',
        ]);

        //return types
        ReturnType::create([
            'name' => 'الطريقة الاولي',
        ]);
        ReturnType::create([
            'name' => 'الطريقة الثانية',
        ]);

        //services types
        Service::create([
            'name' => 'الخدمة الاولي',
        ]);
        Service::create([
            'name' => 'الخدمة الثانية',
        ]);


        //Plocy types
        ReturnPolicy::create([
            'name' => 'السياسة الاولي',
        ]);
        ReturnPolicy::create([
            'name' => 'السياسة الثانية',
        ]);


        ///
        $faker = Faker::create();

        // Define arrays of possible values
        $carTypes = ['Opel', 'Toyota', 'Ford', 'Honda', 'BMW'];
        $carModels = [
            'Opel' => ['Astra', 'Corsa', 'Insignia'],
            'Toyota' => ['Corolla', 'Camry', 'RAV4'],
            'Ford' => ['Fiesta', 'Focus', 'Mustang'],
            'Honda' => ['Civic', 'Accord', 'CR-V'],
            'BMW' => ['3 Series', '5 Series', 'X5']
        ];
        $years = ['2019', '2020', '2021', '2022', '2023'];
        $prices = ['200', '250', '300', '350', '400'];

        for ($i = 0; $i < 30; $i++) {

            $type = $faker->randomElement($carTypes);

            $model = $faker->randomElement($carModels[$type]);

            $car = Car::create([
                'type' => $type,
                'model' => $model,
                'year' => $faker->randomElement($years),
                'price' => $faker->randomElement($prices),
                'assurance' => $faker->numberBetween(0, 1),
                'number' => $faker->bothify('####KSA'),
                'licence_file' => 'uploads/licence.jpg',
                'kilos' => $faker->numberBetween(100, 500),
                'with_driver' => $faker->numberBetween(0, 1),
                'status' => '0',
                'company_id' => 1,
                'branch_id' => 1
            ]);

            $car->rentTypes()->attach($rent1);

            $car->rentTypes()->attach($rent2);

            for($J = 0; $J < 3; $J++) {
                $car->files()->create([
                    'path' => 'cars/'. $car->id . '.jpg'
                ]);
            }
            
        }
    }
}
