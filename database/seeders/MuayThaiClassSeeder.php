<?php

namespace Database\Seeders;

use App\Models\MuayThaiClass;
use App\Models\User;
use Illuminate\Database\Seeder;

class MuayThaiClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->line("Generating 15 classes");
        MuayThaiClass::factory(15)->create();
    }
}
