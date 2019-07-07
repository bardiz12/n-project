<?php
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class calonDprSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create('id_ID');
        $i = 0;
        while ($i <= 20) {
            # code...
            \App\Model\calonDpr::create([
                'nama_calon_dpr' => $faker->name,
                'foto' => $faker->imageUrl(400, 400, 'people'),
                'partai_id' => rand(0,9)
            ]);
            $i++;
        }
    }
}
