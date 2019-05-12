<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class tableUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'email'=>'info@bardizba.com',
            'name'=>'Bardizba Z',
            'password'=>Hash::make('12345678')
        ]);
        $user->roles()->attach([1]); 

        
    }
}
