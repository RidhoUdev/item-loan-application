<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;

class OperatorController extends Controller
{
    public function dashboard()
    {
        return view('operator.dashboard');
    }
}
