<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Notification::create([
            'head' => 'تم شحن مبلغ مالي إلى محفظتك بنجاح',
            'body' => 'يتم توضيح تفاصيل الإشعار هنا على سطر واحد أو على سطرين اثنين',
            'user_id' => 1
        ]);
        Notification::create([
            'head' => 'السيارة وصلت إلى الموقع المختار',
            'body' => 'يتم توضيح تفاصيل الإشعار هنا على سطر واحد أو على سطرين اثنين',
            'user_id' => 1
        ]);
        Notification::create([
            'head' => 'تم شحن مبلغ مالي إلى محفظتك بنجاح',
            'body' => 'يتم توضيح تفاصيل الإشعار هنا على سطر واحد أو على سطرين اثنين',
            'user_id' => 1
        ]);
    }
}
