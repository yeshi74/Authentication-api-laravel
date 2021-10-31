@extends('layouts/contentLayoutMaster')
@section('title', 'Blog Category')
@section('content')
{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>""))!!}

  
  
  <form method="post" action="{{ route('blogcategory.save') }}" ENCTYPE="multipart/form-data">
          {{ csrf_field() }}
            {!!Helper::textbox(array("colspan"=>12,"label"=>"Name","name"=>"name","class"=>"validate['required']","typ"=>"text"))!!}
            {!!Helper::textbox(array("colspan"=>12,"label"=>"Image","name"=>"img","class"=>"validate['required']","typ"=>"file"))!!}
            <div class="form-group">
                <label for="details">Select Status</label>
                  <select class="form-control" name="status">
                      <option>0</option>
                      <option>10</option>
                  </select>
              </div>
            {!! Helper::button(array("colspan"=>12,"name"=>"btnUpdate","label"=>"Create","type"=>"submit")) !!}
            </form>
  {!! Helper::close("form")!!}
  {!! Helper::closePage() !!}
@endsection

@section('myscript')
<script>
   $("#btnUpdate").on('click',function()
  {
    $("#frm").submit();
  });
</script>
@endsection