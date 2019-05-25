<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Model\Form\FormMaintainer;
use Illuminate\Support\Facades\Auth;
use App\Helper\Alert;

class InvitationController extends Controller
{
    //
    public function store(Request $request){
        $headers = [];
        $validate = Validator::make($request->all(),[
            'id'=>'min:1|required', 
        ]);        

        if($validate->fails()){
            return response()->json([
                'status'=>'error',
                'title'=>'Error!',
                'msg'=>Alert::errorList($validate->errors())
            ], 200, $headers);   
        }
    	$search = FormMaintainer::where('id',$request->input('id'))->first();
    	$search->status = 1;
    	$search->save();
    	#var_dump($search);

        return response()->json([
            'title'=>'Berhasil',
            'msg'=>'Survey berhasil ditambahkan!',
            'status'=>'success',
            'redirect_to'=>route('account.invitations')
        ], 200, $headers);
    }
}
