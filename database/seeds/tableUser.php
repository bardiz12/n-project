<?php

use App\User;
use Illuminate\Database\Seeder;
use App\Model\Form\FormMaintainer;
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
        FormMaintainer::create([
            'form_id'=>2,
            'users_id'=>$user->id,
            'maintainer_roles_id'=>1,
            'status'=>1,
            'added_by'=>$user->id,
        ]);
        factory(App\User::class, 10)->create()->each(function ($user) {
            FormMaintainer::create([
                'form_id'=>2,
                'users_id'=>$user->id,
                'maintainer_roles_id'=>3,
                'status'=>1,
                'added_by'=>1,
            ]);
        });
        factory(App\User::class, 1)->create()->each(function ($user) {
            FormMaintainer::create([
                'form_id'=>2,
                'users_id'=>$user->id,
                'maintainer_roles_id'=>2,
                'status'=>1,
                'added_by'=>1,
            ]);
        });
        factory(App\User::class, 20)->create();
        
        

        
    }
}
