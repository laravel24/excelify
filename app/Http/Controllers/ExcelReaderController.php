<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PHPExcel_IOFactory;

use Storage;
use Log;

class ExcelReaderController extends Controller
{

    public function index(){
        return view('dexcel/index');
    }
    
    public function __invoke(Request $r){
        //記住input
        $r->flash();
        //起始欄位
        $start_column = strtoupper(preg_replace('/(\\w+)(\\d+)/um', '$1', $r->start));

        $arrFieldName = $r->fieldName; //欄位
        $arrFieldValue = $r->fieldValue; //值
        $arrFieldKvMap = $r->fieldKvMap;

        if (!isset($r->excelfile)&&$r->session()->has('path')) {
            $path = session('path');
        }else{
            //$path = $r->file('excelfile')->store('files', 'local', 'temp.xls');
            //固定的檔案
            $path = Storage::putFileAs('excelfile',$r->file('excelfile') , 'temp.xls');
            session(['path'=>$path]);
        }

        $sheetnum = $r->sheetnum-1; //初始為0

        $filePath = storage_path(sprintf("app/%s",$path));  
        try {
            $inputFileType = PHPExcel_IOFactory::identify($filePath);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($filePath);
        } catch(Exception $e) {
            die('Error loading file "'.pathinfo($filePath,PATHINFO_BASENAME).'": '.$e->getMessage());
        }

        //取得Sheet0
        $sheet = $objPHPExcel->getSheet($sheetnum);
        if(!$r->end){
          $highestColumn = $sheet->getHighestColumn(); //最大欄寬的英文，例如: BH
          $highestRow = $sheet->getHighestRow();       //最大的列數
          $r->end=$highestColumn.$highestRow;
      }
      if(is_null($r->start)){
        $r->start="A1"; 
      }
      //最大欄寬
      if(is_null($r->end)){
         $highestColumn = $sheet->getHighestColumn(); //最大欄寬的英文，例如: BH
         $highestRow = $sheet->getHighestRow(); //最大列數
         $r->end = $highestColumn.$highestRow;
      }

        //依設定的，啟始欄位一行一行存入Array中
      $rowData = $sheet->rangeToArray($r->start.':'.$r->end,
        NULL,
        TRUE,
        FALSE);

      //  dd($rowData);
      //重整
      $rows = [];
      foreach($rowData as $row_num=>$row)
      {
        foreach($row as $column_index=>$column){
            $letters = range('A', 'Z');
            $start_column_index = array_search($start_column, $letters);

            $letter = $this->toLetter($column_index+$start_column_index);

            foreach($arrFieldName as $key_index=>$key){
                if(strtoupper($key)==$letter&&!empty($arrFieldValue[$key_index])){
                    if(is_null($column)) 
                    {
                        $rows[$row_num][$arrFieldValue[$key_index]] = "";
                    }
                    else
                    {
                      //有定義對Kv對印
                      if(!empty(trim($arrFieldKvMap[$key_index]))){
                        $strColumn = preg_replace('/^\\[(.*)\\]$/um', '$1', $arrFieldKvMap[$key_index]);
                        $arrData = explode(",", $strColumn);
                        foreach($arrData as $item){
                           $itemkv = explode("=>",$item); 
                           $result = preg_replace('/^"(.*)"$/um', '$1', trim($itemkv[0]));
                           if($result==$column){
                            $column = preg_replace('/^"(.*)"$/um', '$1', trim($itemkv[1]));
                           }
                        }
                      }
                        $rows[$row_num][$arrFieldValue[$key_index]] = str_replace('"', '\"', $column);
                    }

                }
            }
        }
      }
      /*
    return redirect('/',)
    ->withInput();
    */
    return view('dexcel.index',['data'=>$rows,'datatype'=>$r->datatype,'tablename'=>$r->tablename]);
 }
    //轉入index轉回欄位
  function toLetter($i){
        $letters = range('A', 'Z');
        if($i<=25){
            return $letters[$i];
        }
        if($i>25){
            $quot = ($i+1)/26;
            $rem = ($i+1)%26;
            if( $rem == 0){
               return $letters[$quot-2].$this->toLetter($rem+25); 
            }else{
               return $letters[$quot-1].$this->toLetter($rem-1); 
            }
        }
    }
}
