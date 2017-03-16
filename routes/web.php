<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','ExcelReaderController@index');

Route::post('/','ExcelReaderController');

Route::get('/test/{column_index}',function($column_index){
    function toLetter($i){
        $letters = range('A', 'Z');
        if($i<=25){
            return $letters[$i];
        }
        if($i>25){
            $quot = ($i+1)/26;
            $rem = ($i+1)%26;
            if( $rem == 0){
               return $letters[$quot-2].toLetter($rem+25); 
            }else{
               return $letters[$quot-1].toLetter($rem-1); 
            }
        }
    }
    echo toLetter($column_index);
    echo "<br/>";
    dd($column_index);
});

