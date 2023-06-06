<?php

namespace App\Http\Controllers\clien;

use App\Http\Controllers\Controller;
use App\Products;
use Illuminate\Http\Request;

class apiController extends Controller
{
    public function searchAjax(){
        $data = Products::search()->get();
        return $data;
    }
}
