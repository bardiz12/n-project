<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use App\Helper\Alert;
use Illuminate\Http\Request;
use App\Model\MaintainerRoles;
use App\Model\FOrm;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    public function index(){
        return view('account.dashboard');
    }

    public function surveysIndex(){
        $data = [];
        $data['surveys'] = Auth::user()->formAdmin()->paginate(5);
//        dd($data);
        $data['warna'] = ['','warning','danger','primary'];
        $maintainer_roles = [];
        array_map(function($data) use (&$maintainer_roles){
            return $maintainer_roles[$data['id']] = $data;
        }, MaintainerRoles::all()->toArray());
        $data['maintainer_roles'] = $maintainer_roles;
        return view('account.survey',$data);
        #return json_encode($data);
    }

    public function invitationsIndex(){
        $data = [];
        //$data['surveys'] = Auth::user()->formAdmin()->paginate(5);
//        dd($data);
        $data['invitations'] = Auth::user()->invitationAdmin()->paginate(5);
        $data['warna'] = ['','warning','danger','primary'];
        $maintainer_roles = [];
        array_map(function($data) use (&$maintainer_roles){
            return $maintainer_roles[$data['id']] = $data;
        }, MaintainerRoles::all()->toArray());
        $data['maintainer_roles'] = $maintainer_roles;
        return view('account.invitation',$data);
        #return json_encode($data);
    }
    public function survey_pemilu()
    {
        # code...
        $data['calon'] = \App\Model\calonDpr::all();
        return view('account.pemilu',$data);
    }public function pilih_dpr(Request $request)
    {
        # code...
        $headers = [];
        $validate = Validator::make($request->all(),[
            'pilih_dpr'=>'required',
        ]);
        if($validate->fails()){
            return response()->json([
                'status'=>'error',
                'title'=>'Error!',
                'msg'=>Alert::errorList($validate->errors())
            ], 200, $headers);   
        }else{
            $users = \App\User::find(Auth::user()->id);
            $users->calon_dpr()->sync([$request->input('pilih_dpr')]);
            return response()->json([
                'title'=>'Berhasil',
                'msg'=>'Anda Berhasil Memilih DPR RI !',
                'status'=>'success',
                'redirect_to'=>route('account.survey_pemilu')
            ], 200, $headers);
        }
    }
}
