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
        $this->command->line("Generating 15 posts");
        MuayThaiClass::factory(15)->create();
        $classes = MuayThaiClass::get();
        $classes->each(function($class, $key) {
            $teacher_id = User::where('role', 'TEACHER')->inRandomOrder()->limit(1)->get()->pluck(['id'])->all();
            $class->users()->sync($teacher_id);
        });
    }
}
