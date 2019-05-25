<?php

namespace App\Http\Controllers;

use App\User;
use Validator;
use App\Helper\Alert;
use App\Charts\PieChart;
use App\Model\Form\Form;
use App\Model\Form\Column;
use App\Model\Form\Content;
use Illuminate\Http\Request;
use App\Model\Form\ColumnPilgan;
use App\Model\Form\FormMaintainer;
use App\Http\Controllers\Controller;
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
        $rules['geolocation.lat'] = 'required|numeric'; 
        $rules['geolocation.long'] = 'required|numeric';
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response()->json([
                'status'=>'error',
                'title'=>'Error!',
                'msg'=>Alert::errorList($validator->errors())
            ], 200, $headers);   
        }
        $rules2 = [];
        //check apabila jawaban pilihan ganda tersedia

        foreach ($request->input('jawaban') as $key => $value) {
            $id_pilgan = \substr($key,3);
            $answer[$id_pilgan] = is_array($value) ? ( array_map(function($v){
                        return (int) $v;
                    },$value)) : $value;
            if($types[$id_pilgan] == 'pilgan'){
                foreach ($value as $id_pilgans) {
                    if(!in_array($id_pilgans,$pilgans_id[$id_pilgan])){
                        return response()->json([
                            'status'=>'error',
                            'title'=>'Error!',
                            'msg'=>'Pilihan jawaban untuk kolom ke-'.($key+1)." tidak ditemukan"
                        ], 200, $headers);   
                    }
                }
                
            }
        }
        $konten = Content::create([
            'form_id'=>$id,
            'content'=>$answer,
            'users_id'=>Auth::user()->id,
            'long'=>$request->input('geolocation')['long'],
            'lat'=>$request->input('geolocation')['lat'],
        ]);

        return response()->json([
            'status'=>'success',
            'title'=>'Berhasil Menambahkan',
            'msg'=>"Berhasil Menambahkan"
        ], 200, $headers);   
    }

    public function store(Request $request){
        $headers = [];
        $validate = Validator::make($request->all(),[
            'name'=>'string|required|min:3',
            'description'=>'string|required|min:3',
            'type'=>'array|min:1|required',
            'id'=>'array|min:1|required',
            'pertanyaan'=>'array|min:1|required',
            'pilihan_jawaban'=>'array|min:1'
        ]);

        

        if($validate->fails()){
            return response()->json([
                'status'=>'error',
                'title'=>'Error!',
                'msg'=>Alert::errorList($validate->errors())
            ], 200, $headers);   
        }
        
        $types = $request->input('type');
        $ids = $request->input('id');
        $pertanyaans = $request->input('pertanyaan');
        $pilihans = $request->input('pilihan_jawaban');
        if(!(count($types) === count($ids) && count($ids) === count($pertanyaans))){
            return response()->json([
                'status'=>'error',
                'msg'=>'Form tidak valid',
                'title'=>'Error!'
            ], 200, $headers);
        }


        $calon_id = [];
        foreach ($types as $key => $value) {
            $calon_id[] = $ids[$key];
            if(!in_array($value,$this->allowed_column_types)){
                return response()->json([
                    'status'=>'error',
                    'msg'=>'Jenis pertanyaan '.$value.' tidak ada',
                    'title'=>'Error!'
                ], 200, $headers);
            }
        }

        if(count(array_unique($calon_id)) !== count($calon_id)){
            return response()->json([
                'status'=>'warning',
                'msg'=>'ID pertanyaan harus unique!',
                'title'=>'Warning!'
            ], 200, $headers);
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
        FormMaintainer::create([
            'form_id'=>$form->id,
            'users_id'=>Auth::user()->id,
            'maintainer_roles_id'=>1,
            'status'=>1,
            'added_by'=>Auth::user()->id
        ]);

        return response()->json([
            'title'=>'Berhasil',
            'msg'=>'Survey baru telah dibuat!',
            'status'=>'success',
            'redirect_to'=>route('account.surveys')
        ], 200, $headers);
    }

    public function maintainerIndex($id){
        //$chart = new PieChart;
        //$chart->labels(['One', 'Two', 'Three',]);
        //$dataset = $chart->dataset('My dataset 2', 'line', [5, 2, 10]);
        //$dataset = $chart->dataset('My dataset', 'bar', [5, 2, 90])
        //                ->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838']))
        //                ->color(collect(['#7d5fff','#32ff7e', '#ff4d4d']));
        $data = [];
        $data['form'] = request()->get('theForm');
        $data['formMaintainer'] = $data['form']->allMaintainer()->paginate(5);
        #$data['chart'] = $chart;
        //dd($data['form']->allMaintainer);
        #return view('account.survey.manage.user',$data);
        return json_encode($data);
    }

    public function maintainerInvitationIndex($id){
        $data = [];
        $data['form'] = request()->get('theForm');
        $data['formMaintainer'] = $data['form']->allMaintainer()->paginate(5);
        //dd($data['form']->allMaintainer);
        return view('account.survey.manage.user',$data);
    }

    public function maintainerPromotion(Request $request, $id){
        $headers = [];
        $form = request()->get('theForm');
        $validator = Validator::make($request->all(),[
            'id'=>'required|numeric|exists:users,id',
            'type'=>'require|string|regex:/^(up|down)$/'
        ]);
        $formMaintainer = FormMaintainer::where('form_id',$form->id)->where('users_id',$request->input('id'))->first();
        if($formMaintainer->maintainer_roles_id === 1){
            return response()->json([
                'type'=>'error',
                'msg'=>'Anda tidak memiliki akses'
            ], 200, $headers);
        }
        //TODO : who can demote an admin?
        if($formMaintainer !== null){
            if($request->input('type') === 'up'){
                $formMaintainer->maintainer_roles_id = 2;
                $formMaintainer->save();
                $msg = 'Berhasil menjadikan User sebagai Administrator';
            }else{
                $formMaintainer->maintainer_roles_id = 3;
                $formMaintainer->save();
                $msg = 'Berhasil menjadikan User sebagai Member';
            }
            return response()->json([
                'type'=>'success',
                'msg'=>$msg
            ], 200, $headers);
        }else{
            return response()->json([
                'type'=>'error',
                'msg'=>'Data tidak tersedia'
            ], 200, $headers);
        }
    }

    public function maintainerAdd(Request $request,$id){
        $validator = Validator::make($request->all(),[
            'email'=>'required|email|exists:users,email',
            'role'=>'required|numeric|min:2|max:3'
        ]);
        $headers = [];
        if($validator->fails()){
            return response()->json([
                'type'=>'error',
                'html'=>Alert::errorList($validator->errors()),
                'title'=>'Invitation Error!'
            ], 200, $headers);
        }
        $user = User::where('email',$request->input('email'))->first();
        if(FormMaintainer::where('form_id',$id)->where('users_id',$user->id)->count() > 0){
            return response()->json([
                'type'=>'error',
                'html'=>'This User has been invited!',
                'title'=>'Invitation Error'
            ]);
        }

        FormMaintainer::create([
            'form_id'=>$id,
            'users_id'=>$user->id,
            'status'=>0,
            'added_by'=>Auth::user()->id,
        ]);

        return response()->json([
            'type'=>'success',
            'html'=>$user->name." is invited to your survey!",
            'title'=>'Invitation sent!'
        ]);
    }

    public function maps(Request $request, $id){
        $form = $request->get('theForm');
        $survey = [];
        foreach ($form->column as $key => $value) {
            $survey[$value->id] = [
                'name'=>$value->name,
                'is_pilgan'=>$value->isPilganable(),
                'pilgan'=>$value->isPilganable() ? (function() use ($value){
                    $d = [];
                    foreach ($value->pilgan as $k => $pilgan) {
                        $d[$pilgan->id] = [
                            'value'=>$pilgan->text
                        ];
                    }
                    return $d;
                })() : null
            ];

        }
        //dd($form->content);
        $data = $form->content()->where('long','!=',0)->where('lat','!=',0)->get()->map(function($d){
            return ['author'=>$d->user->name,'long'=>$d->long,'lat'=>$d->lat,'content'=>$d->content];
        });
        return view('form.maps.index',['data'=>$data,'survey'=>$survey]);
    }

    public function maintainerRemove(Request $request,$id){
        $headers = [];
        $validator= Validator::make($request->all(),[
            'user_id'=>'numeric|required|exists:users,id',
            'nama'   =>'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'type'=>'error',
                'html'=>Alert::errorList($validator->errors()),
                'title'=>'Invitation Error!'
            ], 200, $headers);
        }
        $user = FormMaintainer::where('form_id',$id)->where('users_id',$request->input('user_id'))->where('added_by',Auth::user()->id);
        if($user->count() == 0){
            return response()->json([
                'type'=>'error',
                'html'=>'This User not found in survey!!',
                'title'=>'Invitation Error'
            ]);
        }
        FormMaintainer::where('users_id',$request->input('user_id'))->where('added_by',Auth::user()->id)->delete();
        return response()->json([
            'type'=>'success',
            'html'=>$request->input('nama')." is deleted to your survey!",
            'title'=>'Invitation sent!'
        ]);
    }
}
    