<?php

namespace Database\Seeders;

use App\Models\BookingClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        $this->call(OrganizationSeeder::class);
//        $this->call(UserSeeder::class);
//        $this->call(PostSeeder::class);
//        $this->call(CommentSeeder::class);
//        $this->call(TagSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(MuayThaiClassSeeder::class);
        $this->call(BookingClassSeeder::class);
        $this->call(ReceiptSeeder::class);
    }
}
