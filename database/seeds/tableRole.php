<?php

use App\Model\Role;
use Illuminate\Database\Seeder;

class tableRole extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'Administrator'
        ];

        array_map(function($role){
            Role::create([
                'slug'=>strtolower($role),
                'name'=>$role
            ]);
        }, $roles);
    }
}
