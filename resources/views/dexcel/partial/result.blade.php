  @if(count($errors) > 0)
  <span id="error" class="social-auth-links text-center">
    @foreach($errors->all() as $error)
    <label class="text-danger">
      {{$error}}
    </label>
    @endforeach
    @endif
    @if(isset($data))
    <textarea class="form-control" style="width:100%;height:500px">
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