<?php

use Illuminate\Database\Seeder;

class FormTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('form')->delete();
        
        \DB::table('form')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'survey technofari',
                'description' => 'tes12312312',
                'creator_id' => '1',
                'is_public' => 0,
                'created_at' => '2019-05-12 17:03:53',
                'updated_at' => '2019-05-12 17:03:53',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'survey technofari',
                'description' => 'tes12312312',
                'creator_id' => '1',
                'is_public' => 0,
                'created_at' => '2019-05-12 17:08:42',
                'updated_at' => '2019-05-12 17:08:42',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}