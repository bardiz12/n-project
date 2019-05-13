<?php

use Illuminate\Database\Seeder;

class FormColumnPilganTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('form_column_pilgan')->delete();
        
        \DB::table('form_column_pilgan')->insert(array (
            0 => 
            array (
                'id' => 1,
                'form_column_id' => 3,
                'text' => 'Nidji',
                'created_at' => '2019-05-12 17:03:54',
                'updated_at' => '2019-05-12 17:03:54',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'form_column_id' => 3,
                'text' => 'slank',
                'created_at' => '2019-05-12 17:03:54',
                'updated_at' => '2019-05-12 17:03:54',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'form_column_id' => 3,
                'text' => 'rosa',
                'created_at' => '2019-05-12 17:03:54',
                'updated_at' => '2019-05-12 17:03:54',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'form_column_id' => 3,
                'text' => 'mbohlah',
                'created_at' => '2019-05-12 17:03:54',
                'updated_at' => '2019-05-12 17:03:54',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'form_column_id' => 6,
                'text' => 'Nidji',
                'created_at' => '2019-05-12 17:08:42',
                'updated_at' => '2019-05-12 17:08:42',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'form_column_id' => 6,
                'text' => 'slank',
                'created_at' => '2019-05-12 17:08:42',
                'updated_at' => '2019-05-12 17:08:42',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'form_column_id' => 6,
                'text' => 'rosa',
                'created_at' => '2019-05-12 17:08:42',
                'updated_at' => '2019-05-12 17:08:42',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'form_column_id' => 6,
                'text' => 'mbohlah',
                'created_at' => '2019-05-12 17:08:42',
                'updated_at' => '2019-05-12 17:08:42',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'form_column_id' => 8,
                'text' => 'sore',
                'created_at' => '2019-05-12 17:08:42',
                'updated_at' => '2019-05-12 17:08:42',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'form_column_id' => 8,
                'text' => 'malam',
                'created_at' => '2019-05-12 17:08:42',
                'updated_at' => '2019-05-12 17:08:42',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'form_column_id' => 8,
                'text' => 'siang',
                'created_at' => '2019-05-12 17:08:42',
                'updated_at' => '2019-05-12 17:08:42',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'form_column_id' => 9,
                'text' => '<50000',
                'created_at' => '2019-05-12 17:08:42',
                'updated_at' => '2019-05-12 17:08:42',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'form_column_id' => 9,
                'text' => '>=50000',
                'created_at' => '2019-05-12 17:08:42',
                'updated_at' => '2019-05-12 17:08:42',
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'form_column_id' => 9,
                'text' => '100000',
                'created_at' => '2019-05-12 17:08:42',
                'updated_at' => '2019-05-12 17:08:42',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}