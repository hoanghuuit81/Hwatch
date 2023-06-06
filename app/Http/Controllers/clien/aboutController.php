<?php

namespace App\Http\Controllers\clien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class aboutController extends Controller
{
    public function index(){
        return view('clien.pages.about.about');
    }
}
