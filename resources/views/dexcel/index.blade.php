@extends('dexcel.layout.master')
@section('content')
<form action="/" method="POST" role="form" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="row">
        <div class=" col-md-7">
         <table class="table table-hover">
            <tbody>
                <tr>
                    <th colspan="2">
                       用來將Excel檔轉換為其他資料 
                   </th>
               </tr>
               <tr>
                <td class="text-nowrap">
                    <label for="">選擇Excel檔案</label>
                </td>
                <td>
                    <input type="file" name="excelfile" value="">
                </td>
            </tr>

            <tr>
                <td class="form-inline" colspan="2" >
                    Sheet:
                    @if(request()->has('sheetnum'))
                    <input type="number" class="form-control" name="sheetnum" placeholder="Sheet" value="{{request()->old("sheetnum")}}">
                        @else
                    <input type="number" class="form-control" name="sheetnum" placeholder="Sheet" value="1">
                    @endif
                </td>
            </tr>

            <tr class="text-nowrap">
                <td>
                    設定範圍
                </td>
                <td class="form-inline">
                    起始:
                    @if(request()->has('start'))
                    <input type="text" class="form-control" name="start" placeholder="例如: A1" value="{{request()->old("start")}}">
                    @else
                    <input type="text" class="form-control" name="start" placeholder="例如: A1" value="a1">
                    @endif
                    結束:
                    <input type="text" class="form-control" name="end" placeholder="例如:B10" value="{{request()->old('end')}}">
                </td>
            </tr>

            <tr>
                <td class="form-inline" >
                    產出類型 
                </td>
                <td>
                    <label>
                        QueryBuilder:
                        @if(request()->has('datatype'))
                        <input type="radio" name="datatype" value="qb" {{request()->old('datatype')=='qb'?'checked':''}}>
                        @else
                        <input type="radio" name="datatype" value="qb" checked>
                        @endif
                    </label>
                    <label>
                        Array:
                        <input type="radio" name="datatype" value="array" {{request()->old('datatype')=='array'?'checked':''}}>
                    </label>
                    <label>
                        SQL:
                        <input type="radio" name="datatype" value="sql" {{request()->old('datatype')=='sql'?'checked':''}}>
                    </label>
                </td>
            </tr>
            <tr>
                <td class="form-inline" >
                    資料表名稱
                </td>
                <td>
                    <input type="text" name="tablename" value="{{request()->old('tablename')}}">
                    <button type="submit" class="btn btn-warning">轉換</button>
                </td>
            </tr>


        </tbody>
    </table> 
</div>
<div class="col-md-4 col-xs-9" id="app">
    <br/>
    <button type="button" class="btn btn-primary" @click="addColumn">欄位名稱</button>
    Excel欄位轉換
    <p>
        <div class="columnslot">
            <div class="form-inline hide">
                <div class="row">
                    <div class="col-xs-4">
                        <input type="text" class="form-control" name="fieldName[]" value="" placeholder="Excel欄位，例如:a">
                    </div>
                    <div class="col-xs-4">
                        <input type="text" class="form-control" name="fieldValue[]" value="" placeholder="欄位名稱定義">
                    </div>
                    <div class="col-xs-4 ">
                        <button type="button" class="btn btn-danger btnDelete">Delete</button>
                    </div>
                </div>
            </div>
            @if(request()->old('fieldName'))
            @foreach(request()->old('fieldName') as $row_index=>$field_name)
            @php
            if(is_null($field_name)) continue;
            @endphp
            <div class="form-inline">
                <div class="row">
                    <div class="col-xs-4">
                        <input type="text" class="form-control" name="fieldName[]" value="{{$field_name}}" placeholder="Excel欄位，例如:a">
                    </div>
                    <div class="col-xs-4">
                        <input type="text" class="form-control" name="fieldValue[]" value="{{request()->old('fieldValue')[$row_index]}}" placeholder="欄位名稱定義">
                    </div>
                    <div class="col-xs-2">
                        <button type="button" class="btn btn-danger btnDelete">Delete</button>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>
</form>
<div class="result">
    @if(count($errors) > 0)
    <span id="error" class="social-auth-links text-center">
        @foreach($errors->all() as $error)
        <label class="text-danger">
          {{$error}}
      </label>
      @endforeach
      @endif
      @if(isset($data))
      <textarea class="form-control" rows="10">
        {{-- array 格式 --}}
        @if($datatype=='array')
        @include("dexcel.array")
        @endif
        @if($datatype=='sql')
        @include("dexcel.sql")
        @endif
        @if($datatype=='qb')
        @include("dexcel.qb")
        @endif
    </textarea>
    @endif
</div>
@endsection

@section('scripts')
@parent
<script>
    $(function(){

        new Vue({
            el:'#app',
            data:{
                test:'abc'
            },
            methods: {
                addColumn: function(){
                    divColumn = $(".columnslot div:eq(0)").clone();
                    divColumn.removeClass('hide');
                    $("div.columnslot").append(divColumn);
                },
            },
            created: function(){

            }
        });
        $("#app").on('click','button.btnDelete', function(){
            $(this).closest('div.form-inline').remove();
        });

    })
</script>
@endsection