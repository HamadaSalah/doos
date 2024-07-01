<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transaction::create([
            "amount"=> "500",
            'reason' => 'دفع إيجار سيارة',
            'by' => 'مـن رصيـد المحفظـة',
            'user_id' => 1
        ]);
        Transaction::create([
            "amount"=> "500",
            'reason' => 'ناجحة',
            'by' => 'بواسطة كريديت كارد',
            'user_id' => 1
        ]);
    }
}
