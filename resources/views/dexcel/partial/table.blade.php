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