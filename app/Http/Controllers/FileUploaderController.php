<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploaderController extends Controller
{
    //上傳頁面
    public function index(){
        return view('dexcel/index');
    }
}
