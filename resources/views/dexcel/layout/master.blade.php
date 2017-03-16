<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>dExcel</title>
    <link rel="stylesheet" href="/css/app.css">
    <style>
    body{
        margin-top: 2em;
    }
     .columnslot 
     {
        overflow-y:scroll;
        height: 200px;
        padding: 4px;
        border: 1px dashed gray;
     } 
     td>label{
        padding-right:10px;
     }
    </style>
</head>
<body>
    <div class="container">
       <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            @yield('content')
        </div>
    </div> 
</div>
<script src="/js/app.js"></script>
@section('scripts')
@show
</body>
</html>