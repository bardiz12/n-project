<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Model\MaintainerRoles;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    public function index(){
        return view('account.dashboard');
    }

    public function surveysIndex(){
        $data = [];
        $data['surveys'] = Auth::user()->formAdmin;
        $data['warna'] = ['','warning','danger','primary'];
        $maintainer_roles = [];
        array_map(function($data) use (&$maintainer_roles){
            return $maintainer_roles[$data['id']] = $data;
        }, MaintainerRoles::all()->toArray());
        $data['maintainer_roles'] = $maintainer_roles;
        return view('account.survey',$data);
    }
}
