@extends('layouts/contentLayoutMaster')
@section('title', 'Pincode')
@section('content')
{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>""))!!}

  
  
  <form method="post" action="{{ route('pincode.save') }}" ENCTYPE="multipart/form-data">
          <div class="form-group">
          {{ csrf_field() }}
          {!!Helper::textbox(array("colspan"=>12,"label"=>"Pincode","name"=>"pincode","class"=>"validate['required']","typ"=>"number"))!!}
          </div>
            {!!Helper::textbox(array("colspan"=>12,"label"=>"Location","name"=>"place","class"=>"validate['required']","typ"=>"text"))!!}
            {!! Helper::button(array("colspan"=>12,"name"=>"btnUpdate","label"=>"Create","type"=>"submit")) !!}
            </form>

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