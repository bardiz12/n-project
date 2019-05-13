<?php

use Illuminate\Database\Seeder;

class FormColumnTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('form_column')->delete();
        
        \DB::table('form_column')->insert(array (
            0 => 
            array (
                'id' => 1,
                'form_id' => 1,
                'name' => 'nama',
                'pertanyaan' => 'Siapa nama kamu?',
                'type' => 'text',
                'created_at' => '2019-05-12 17:03:53',
                'updated_at' => '2019-05-12 17:03:53',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'form_id' => 1,
                'name' => 'nim',
                'pertanyaan' => 'berapa nim kamu?',
                'type' => 'text',
                'created_at' => '2019-05-12 17:03:53',
                'updated_at' => '2019-05-12 17:03:53',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'form_id' => 1,
                'name' => 'band',
                'pertanyaan' => 'Pilihan Band yang kamu ingin mereka hadir di technofair?',
                'type' => 'checkbox',
                'created_at' => '2019-05-12 17:03:54',
                'updated_at' => '2019-05-12 17:03:54',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'form_id' => 2,
                'name' => 'nama',
                'pertanyaan' => 'Siapa nama kamu?',
                'type' => 'text',
                'created_at' => '2019-05-12 17:08:42',
                'updated_at' => '2019-05-12 17:08:42',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'form_id' => 2,
                'name' => 'nim',
                'pertanyaan' => 'berapa nim kamu?',
                'type' => 'text',
                'created_at' => '2019-05-12 17:08:42',
                'updated_at' => '2019-05-12 17:08:42',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'form_id' => 2,
                'name' => 'band',
                'pertanyaan' => 'Pilihan Band yang kamu ingin mereka hadir di technofair?',
                'type' => 'checkbox',
                'created_at' => '2019-05-12 17:08:42',
                'updated_at' => '2019-05-12 17:08:42',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'form_id' => 2,
                'name' => 'alamat',
                'pertanyaan' => 'masukan alamat lengkap kamu',
                'type' => 'textarea',
                'created_at' => '2019-05-12 17:08:42',
                'updated_at' => '2019-05-12 17:08:42',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'form_id' => 2,
                'name' => 'waktu',
                'pertanyaan' => 'Waktu Jam pelaksanaan paling tepat?',
                'type' => 'radio',
                'created_at' => '2019-05-12 17:08:42',
                'updated_at' => '2019-05-12 17:08:42',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'form_id' => 2,
                'name' => 'htm',
                'pertanyaan' => 'harga tiket masuk paling cocok',
                'type' => 'select',
                'created_at' => '2019-05-12 17:08:42',
                'updated_at' => '2019-05-12 17:08:42',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}