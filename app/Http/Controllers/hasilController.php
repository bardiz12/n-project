<?php

namespace App\Http\Controllers;

use App\Charts\pemiluChart;
use Faker\Factory as Faker;

class hasilController extends Controller
{
    //
    protected $jumlah_kursi = 10;
    public function sainte_lague($suara, $jumlah_kursi)
    {
        # code...
        $jumlah_suara = 0;
        foreach ($suara as $value => $key) {
            # code...
            $jumlah_suara += $key['jumlah_suara'];
            $suara[$value]['indeks_kursi'] = 1;
            $suara[$value]['jumlah_kursi'] = 0;

        }
        foreach ($suara as $key => $value) {
            # code...
            if ($value['jumlah_suara'] < 0.04 * $jumlah_suara) {
                # code...
                unset($suara[$key]);
            }
        }
        $i = 0;
        while ($i < $jumlah_kursi) {
            # code...
            $temp[] = [];
            if ($i == 0) {
                # code...
                foreach ($suara as $key => $value) {
                    $temp[$i][$key] = $value['jumlah_suara'];
                }
            }
            $temp[$i]['max'] = max($temp[$i]);
            foreach ($suara as $key => $value) {
                # code...
                if ($temp[$i][$key] == $temp[$i]['max']) {
                    # code...
                    $suara[$key]['indeks_kursi'] += 2;
                    $suara[$key]['jumlah_kursi'] += 1;
                    $temp[$i + 1][$key] = $suara[$key]['jumlah_suara'] / $suara[$key]['indeks_kursi'];
                } else {
                    $temp[$i + 1][$key] = $temp[$i][$key];
                }
            }
            $i++;
        }

     //   $suara = json_decode(json_encode(json_encode($suara)));
        return $suara;
    }

    public function hasil()
    {
        # code...
        $chart = new pemiluChart;
        $partai = \App\Model\Partai::all();
//        $chart->labels([]);
        $nama_partai = collect([]);
        $jumlah_suara = collect([]);
        $faker = Faker::create('id_ID');
        $warna = collect([]);
        $hasill[] = [];
        foreach ($partai as $key => $value) {
            # code...

            $suara = 0;
            foreach ($value->calon_dpr()->get() as $keys => $values) {
                # code...
                $suara += count($values->users()->get());
            }
            $nama_partai->push($value->nama_partai);
            $jumlah_suara->push($suara);
            $hasil[$key]['nama_partai'] = $value->nama_partai;
            $hasil[$key]['jumlah_suara'] = $suara;
            $warna->push($faker->hexcolor);
        }

        $chart->labels($nama_partai);
        $chart->dataset('ma', 'pie', $jumlah_suara)->backgroundcolor($warna);
        $data['chart'] = $chart;
        $data['hasil'] = $this->sainte_lague($hasil,$this->jumlah_kursi);
       
        return view('hasil-pemilu', $data);
        //return $partai;
    }
    
}
