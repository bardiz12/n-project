<?php

namespace App\Http\Controllers;

use App\Model\Form\Form;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Form\Dashboard\Element;
use App\Charts\SampleChart;

class SurveyReportController extends Controller
{
    public function create(Request $request,$id){
        $data = [
            'chart_type'=>Element::where('type','chart')->get(),
            'form'=> Form::with('column')->with('column.pilgan')->find($id)
        ];
        return view('account.survey.report.create',$data);
    }

    public function index($id){
        $chart = new SampleChart;
        $chart->labels(['One', 'Two', 'Three']);
        $data = [
            'chart_type'=>Element::where('type','chart')->get(),
            'form'=> Form::with('column')->with('column.pilgan')->find($id)
        ];
        return view('account.survey.report.index',$data);
    }
    
}
