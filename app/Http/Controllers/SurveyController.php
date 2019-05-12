<?php

namespace App\Http\Controllers;

use Validator;
use App\Helper\Alert;
use App\Model\Form\Form;
use App\Model\Form\Column;
use App\Model\Form\Content;
use Illuminate\Http\Request;
use App\Model\Form\ColumnPilgan;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
{
    private $pilgan_types = ['checkbox','radio','select'];
    private $allowed_column_types = ['checkbox','radio','select','text','textarea'];
    public function buat(){
        return view("form.buat");
    }

    public function write($id){
        $form = Form::find($id);
        return view('form.tulis',['form'=>$form]);
    }

    public function saveWrite(Request $request,$id){
        $headers = [];
        $form = Form::find($id);
        $rules = [];
        $koloms = [];
        $types = [];
        $pilgans_id = [];
        foreach ($form->column as $key => $kolom) {
            $rules['jawaban.ke-'.$kolom->id] = (function() use ($kolom,&$types,&$pilgans_id){
                if($kolom->isPilganable()){
                    $pilgans_id[$kolom->id] = array_map(function($k){
                        return $k['id'];
                    },$kolom->pilgan->toArray());
                    $types[$kolom->id] = 'pilgan';
                    return 'array|min:1|required';
                }else{
                    $pilgans_id[] = null;
                    $types[$kolom->id] = 'not_pilgan';
                    return 'string|min:1|required';
                }
            })(); 
        }
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json([
                'status'=>'error',
                'title'=>'Error!',
                'html'=>Alert::errorList($validator->errors())
            ], 200, $headers);   
        }
        $rules2 = [];
        //check apabila jawaban pilihan ganda tersedia

        foreach ($request->input('jawaban') as $key => $value) {
            //dd(\substr($key,11));
            $id_pilgan = \substr($key,3);
            $answer[$id_pilgan] = $value;
            if($types[$id_pilgan] == 'pilgan'){
                foreach ($value as $id_pilgans) {
                    if(!in_array($id_pilgans,$pilgans_id[$id_pilgan])){
                        return response()->json([
                            'status'=>'error',
                            'title'=>'Error!',
                            'html'=>'Pilihan jawaban untuk kolom ke-'.($key+1)." tidak ditemukan"
                        ], 200, $headers);   
                    }
                }
                
            }
        }
        $konten = Content::create([
            'form_id'=>$id,
            'content'=>json_encode($answer),
            'users_id'=>Auth::user()->id
        ]);

        dd($konten->toArray());


        
    }

    public function store(Request $request){
        $headers = [];
        $validate = Validator::make($request->all(),[
            'name'=>'string|required|min:3',
            'description'=>'string|required|min:3',
            'type'=>'array|min:1|required',
            'id'=>'array|min:1|required',
            'pertanyaan'=>'array|min:1|required',
            'pilihan_jawaban'=>'array|min:1|required'
        ]);

        

        if($validate->fails()){
            return response()->json([
                'status'=>'error',
                'title'=>'Error!',
                'html'=>Alert::errorList($validate->errors()->all())
            ], 200, $headers);   
        }
        
        $types = $request->input('type');
        $ids = $request->input('id');
        $pertanyaans = $request->input('pertanyaan');
        $pilihans = $request->input('pilihan_jawaban');
        if(!(count($types) === count($ids) && count($ids) === count($pertanyaans))){
            return response()->json([
                'status'=>'error',
                'html'=>'Form tidak valid',
                'title'=>'Error!'
            ], 200, $headers);
        }

        foreach ($types as $key => $value) {
            if(!in_array($value,$this->allowed_column_types)){
                return response()->json([
                    'status'=>'error',
                    'html'=>'Jenis pertanyaan '.$value.' tidak ada',
                    'title'=>'Error!'
                ], 200, $headers);
            }
        }

        $id_pertanyaan = [];

        $form = new Form();
        $form->name = $request->input('name');
        $form->description = $request->input('description');
        $form->creator_id = Auth::user()->id;
        $form->save();
        foreach ($pertanyaans as $key => $pertanyaan) {
            $kolom = new Column();
            $kolom->form_id = $form->id;
            $kolom->name = $ids[$key];
            $kolom->pertanyaan = $pertanyaan;
            $kolom->type = $types[$key];
            $kolom->save();
            if(in_array($kolom->type,$this->pilgan_types)){
                foreach ($pilihans[$key] as $i => $jawabannya) {
                    $pilgan = new ColumnPilgan();
                    $pilgan->form_column_id = $kolom->id;
                    $pilgan->text = $jawabannya;
                    $pilgan->save();
                }
            }
        }
    }
}
