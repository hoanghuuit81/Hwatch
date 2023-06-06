<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Hoang Hai Huu';
        $user->email = 'hoanghuulopb@gmail.com';
        $user->password = Hash::make('sieunhan'); 
        $user->save();
    }
}
