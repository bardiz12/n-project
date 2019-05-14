<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SurveyReportController extends Controller
{
    public function create(){
        return view('account.survey.report.create');
    }
}
