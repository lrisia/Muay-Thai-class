<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('username', 'Irisia')->first();
        if (!$user) {
            $user = new User;
            $user->name = "Irisia Lightsky";
            $user->username = "Irisia";
            $user->phone = "0811111111";
            $user->address = "home";
            $user->hours = 10;
            $user->role = 'TEACHER';
            $user->email = 'irisia@gmail.com';
            $user->password = Hash::make('teachpass');
            $user->save();
        }

        $user = User::where('username', 'user01')->first();
        if (!$user) {
            $user = new User;
            $user->name = "user01 user";
            $user->username = "user01";
            $user->phone = "0811111112";
            $user->address = "home";
            $user->hours = 10;
            $user->role = 'USER';
            $user->email = 'user01@gmail.com';
            $user->password = Hash::make('userpass');
            $user->save();
        }

        $user = User::where('username', 'manager')->first();
        if (!$user) {
            $user = new User;
            $user->name = "Anya F.";
            $user->username = "Anya";
            $user->phone = "0811111113";
            $user->address = "admin home";
            $user->hours = 1;
            $user->role = 'MANAGER';
            $user->email = 'manager@gmail.com';
            $user->password = Hash::make('managerpass');
            $user->save();
        }

//        $user = User::where('email', 'staff03@example.com')->first();
//        if (!$user) {
//            $user = new User;
//            $user->name = "Ainz G.";
//            $user->role = 'STAFF';
//            $user->email = 'staff03@example.com';
//            $user->password = Hash::make('staffpass');
//            $user->organization_id = "3";
//            $user->save();
//        }
//
//        $user = User::where('email', 'staff04@example.com')->first();
//        if (!$user) {
//            $user = new User;
//            $user->name = "Sora S.";
//            $user->role = 'STAFF';
//            $user->email = 'staff04@example.com';
//            $user->password = Hash::make('staffpass');
//            $user->organization_id = "4";
//            $user->save();
//        }
//
//        $user = User::where('email', 'user01@example.com')->first();
//        if (!$user) {
//            $user = new User;
//            $user->name = "ยูสเซอร์ 01";
//            $user->role = 'USER';
//            $user->email = 'user01@example.com';
//            $user->password = Hash::make('userpass');
//            $user->save();
//        }

        User::factory(10)->create();
    }
}
