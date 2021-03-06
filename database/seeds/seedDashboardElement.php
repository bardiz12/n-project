<?php

use Illuminate\Database\Seeder;
use App\Model\Form\Dashboard\Element;

class seedDashboardElement extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('id_ID');
        $names = ['Table','Bar','Doughnat','Line','Map'];
        $class_name = [null,'bar','doughnut','line',null];
        $type = ['table','chart','chart','chart','map'];
        for ($i=0; $i < count($names); $i++) { 
            Element::create([
                'slug'=>strtolower($names[$i]),
                'class_name'=>$class_name[$i],
                'name'=>$names[$i],
                'type'=>$type[$i],
                'description'=>$faker->text(50)
            ]);
        }
    }
}
