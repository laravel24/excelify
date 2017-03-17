@extends('dexcel.layout.master')
@section('content')
<form action="/" method="POST" role="form" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="row">
        <div class=" col-md-7">
            {{-- 左方的表單 --}}
            @include('dexcel.partial.table')
        </div>
        <div class="col-md-4 col-xs-9" id="app">
            {{-- 右方的表單 --}}
            @include('dexcel.partial.columns')
        </div>
    </div>
</form>
<div class="result">
    {{-- 結果 --}}
    @include('dexcel.partial.result')
</div>
@endsection

@section('scripts')
@parent
<script>

</script>
@endsection