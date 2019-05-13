<?php

use Illuminate\Database\Seeder;

class FormContentTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('form_content')->delete();
        
        \DB::table('form_content')->insert(array (
            0 => 
            array (
                'id' => 1,
                'form_id' => 2,
                'content' => '{"4":"Bardizba Z","5":"46114123","6":["6"],"7":"Selamat datang","8":["10"],"9":["13"]}',
                'users_id' => 1,
                'long' => 0.0,
                'lat' => 0.0,
                'created_at' => '2019-05-12 18:26:21',
                'updated_at' => '2019-05-12 18:26:21',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'form_id' => 2,
                'content' => '{"90":"Bardizba Z","5":"46114123","6":["6"],"7":"Selamat datang","8":["10"],"9":["13"]}',
                'users_id' => 1,
                'long' => 0.0,
                'lat' => 0.0,
                'created_at' => '2019-05-12 18:26:21',
                'updated_at' => '2019-05-12 18:26:21',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'form_id' => 2,
                'content' => '{"4":"Bard","5":"46114160923","6":["6"],"7":"adsiasiod","8":["10"],"9":["13"]}',
                'users_id' => 1,
                'long' => 110.39,
                'lat' => -7.05,
                'created_at' => '2019-05-13 06:50:59',
                'updated_at' => '2019-05-13 06:50:59',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}