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
                    <input type="text" class="hide" name="fieldKvMap[]" value="">
                    <div class="btn-group">
                        <a class="btn btn-primary" data-toggle="modal" href='#modal-arrayMap'>Define</a>
                        <button type="button" class="btn btn-danger btnDelete">Delete</button>
                    </div>
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
                <div class="col-xs-4">
                    <input type="text" class="hide" name="fieldKvMap[]" value="{{request()->old('fieldKvMap')[$row_index]}}">
                    <div class="btn-group">
                        <a class="btn btn-primary" data-toggle="modal" href='#modal-arrayMap'>Define</a>
                        <button type="button" class="btn btn-danger btnDelete">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>

    <div class="modal fade" id="modal-arrayMap">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">轉換</h4>
                </div>
                <div class="modal-body">
                <textarea name="" id="input" class="form-control" rows="4" placeholder='["Taipei"=>"1","Panchiao"=>"2"]' v-model="mapData"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="addMap">確認</button>
                </div>
            </div>
        </div>
    </div>