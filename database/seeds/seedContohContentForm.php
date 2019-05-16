<?php

use App\Model\Form\Form;
use App\Model\Form\Content;
use Illuminate\Database\Seeder;

class seedContohContentForm extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('id_ID');
        //$template = `{"4":"Florentino","5":"8990239012","6":[5,6,7],"7":"disini aku masih sendiri","8":[11],"9":[12]}`;
        $i = 0;
        $id_form = 2;
        $form = Form::find($id_form);
        $kolom = $form->column;
        $datas = [];
        $long = 110.40;
        $lat = -7.06;
        $total_seed = 200;
        while($i < $total_seed){
            foreach ($kolom as $je => $k) {
                if($k->isPilganable()){
                    $jumlah = $k->pilgan()->count();
                    $data[$k->id] = (function() use ($k,$jumlah){
                        if($k->type == 'checkbox'){
                            $r = rand(1,$jumlah);
                            $ddr = array_map(function($ee){
                                return $ee['id'];
                            }, $k->pilgan()->inRandomOrder()->limit($r)->get()->toArray());
                            sort($ddr);
                            return $ddr;
                        }else{
                            return [$k->pilgan()->inRandomOrder()->first()->id];
                        }
                    })();
                }else{
                    if($k->name == 'nim'){
                        $data[$k->id] = rand(1111111,9999999);
                    }else if($k->name == 'nama'){
                        $data[$k->id] = $faker->name;
                    }else if($k->name == 'alamat'){
                        $data[$k->id] = $faker->address;
                    }
                    
                }
            }
            $datas[] = $data;

            Content::create([
                'form_id'=>$id_form,
                'content'=>$data,
                'users_id'=>1,
                'long' => $long + (rand(0, 20) / 100.00),
                'lat' => $lat + (rand(0,10)/100.00)
            ]);
            $i++;
        }
        //dd($datas);
    }
}
