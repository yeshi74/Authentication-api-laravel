@extends('layouts/contentLayoutMaster')
@section('title', 'Feedbacks')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>""))!!}
  {{-- @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
          <h5 style="color:#c80000;"><li>{{ $error }}</li></h5>
        @endforeach
    </ul>
  </div><br />
@endif --}}
  {!! Helper::form(array("name"=>"frm","action"=>"admin/feedback/update","validate"=>"Yes"))!!}
  {!! Helper::hidden(array("name"=>"action","value"=>"update"))!!}
  {!! Helper::hidden(array("name"=>"id","value"=>$id))!!}
  {!! Helper::button(array("colspan"=>12,"name"=>"btnUpdate","label"=>"Update","type"=>"button")) !!}
  
  <div class="row">
    {!!Helper::selectList(array("colspan"=>4,"label"=>"Author","name"=>"author","options"=>$getAuthor,"value"=>"","key"=>"id","val"=>"name","value"=>$results['author']))!!}
    {!!Helper::selectStatus(array("colspan"=>4,"label"=>"Status","name"=>"status","value"=>$results['status'])) !!}
  </div>

  {!!Helper::textbox(array("colspan"=>12,"label"=>"Message","name"=>"message","class"=>"validate['required']","typ"=>"HTML","value"=>$results['message']))!!}
  
  {!! Helper::close("form")!!}
  {!! Helper::closePage() !!}
@endsection

@section('myscript')
<script>
   $("#btnUpdate").on('click',function()
  {
    $("#frm").submit();
  });
  
// $(document).ready(
// function () {
// $('input[type="text"],textarea').bind('change', function () {
// // $('textarea[id$=txtfpconfirmcomments]').change(function (event) {
// alert(this.id);
// if (this.value.match(/[^a-zA-Z0-9 ]/g)) {
// this.value = this.value.replace(/[^a-zA-Z0-9 ]/g, '');
// }
// });
// });
</script>
@endsection