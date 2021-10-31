@extends('layouts/contentLayoutMaster')
@section('title', 'FAQ')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>""))!!}
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
      </ul>
    </div><br />
  @endif
  {!! Helper::form(array("name"=>"frm","action"=>"admin/faq/update","validate"=>"Yes")) !!}
  {!! Helper::hidden(array("name"=>"action","value"=>"update"))!!}
  {!! Helper::hidden(array("name"=>"id","value"=>$id))!!}
  {!! Helper::button(array("colspan"=>12,"name"=>"btnUpdate","label"=>"Update","type"=>"button")) !!}

  {!! Helper::textbox(array("colspan"=>12,"label"=>"Question","name"=>"question","placeholder"=>"Enter Question","class"=>"validate['required']","typ"=>"HTML","value"=>$results['question'])) !!}
  {!! Helper::textbox(array("colspan"=>12,"label"=>"Answer","name"=>"answer","placeholder"=>"Enter Answer","class"=>"validate['required']","typ"=>"HTML","value"=>$results['answer'])) !!}
 
  
  <div class="row">
    {!! Helper::selectList(array("colspan"=>4,"label"=>"Category","name"=>"category","options"=>$getCategory,"value"=>"","key"=>"id","val"=>"name","value"=>$results['category'])) !!}
    {!! Helper::selectList(array("colspan"=>4,"label"=>"Author","name"=>"author","options"=>$getAuthor,"value"=>"","key"=>"id","val"=>"name","value"=>$results['name'])) !!}
    {!! Helper::selectStatus(array("colspan"=>4,"label"=>"Status","name"=>"status","value"=>$results['status'])) !!}
  </div>

  {!! Helper::close("form")!!}
  {!! Helper::gallery(array("module"=>"FAQ","id"=>$id,"mode"=>"EDIT")) !!}
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