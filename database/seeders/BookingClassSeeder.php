<?php

namespace Database\Seeders;

use App\Models\BookingClass;
use App\Models\MuayThaiClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->line("Generating 15 booking");
        BookingClass::factory(100)->create();

        $classes = MuayThaiClass::all();
        foreach ($classes as $class) {
            $class->enrolled_member = BookingClass::where('muay_thai_class_id', $class->id)->count();
            $class->save();
        }
    }
}
