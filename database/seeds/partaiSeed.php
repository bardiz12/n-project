<?php
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class partaiSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $partai = ['PDIP','Golkar','Nasdem','Gerindra','PKS','PAN','PSI','Garuda','Berkarya','PUKI'];
        $faker = Faker::create('id_ID');
        array_map(function($partai) use ($faker) {
            \App\Model\Partai::create([
                'nama_partai' => $partai,
                'logo' => $faker->imageUrl(400, 400, 'abstract', true, $partai) 
            ]);
        },$partai);
    }
}
