<?php

use Faker\Factory as Faker;
use App\Model\MaintainerRoles;
use Illuminate\Database\Seeder;

class tableMaintainerRoles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['Creator','Maintainer','Member'];
        $faker = Faker::create('id_ID');
        array_map(function($role) use ($faker){
            MaintainerRoles::create([
                'slug'=>strtolower($role),
                'name'=>$role,
                'description'=>$faker->text(150)
            ]);
        },$roles);
    }
}
