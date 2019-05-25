<?php

namespace App\Http\Controllers;

use Auth;
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
}
