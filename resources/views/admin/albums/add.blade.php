@extends('layouts/contentLayoutMaster')
@section('title', 'Albums')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>"")) !!}
  {!! Helper::form(array("name"=>"frm","action"=>"admin/albums/save","validate"=>"Yes")) !!}
  {!! Helper::hidden(array("name"=>"action","value"=>"save")) !!}
  {!! Helper::hidden(array("name"=>"id","value"=>"")) !!}
  {!! Helper::button(array("colspan"=>12,"name"=>"btnUpdate","class"=>"btn btn-primary btnAction","label"=>"Save Album","type"=>"submit"))!!}
 
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
  <div class="row">
    {!! Helper::textbox(array("colspan"=>8,"label"=>"Subject","name"=>"subject","placeholder"=>"Enter Subject","class"=>"validate[required]","required"=>"Yes","max"=>150,"value"=>old('subject')))!!}
   {{--  {!! Helper::textbox(array("colspan"=>4,"label"=>"Location","name"=>"location","placeholder"=>"Enter Location","class"=>"validate[required]","required"=>"Yes","value"=>old('location')))!!} --}}

   {!! Helper::listLocations(array("colspan"=>4,"label"=>"Location","name"=>"location","multiple"=>"No","blank"=>"Yes","value"=>old('location')))!!}

    
  </div>
  <div class="row">
    {!! Helper::selectList(array("colspan"=>4,"label"=>"Submitted By","name"=>"author","options"=>$getAuthor,"key"=>"id","val"=>"name","value"=>old('author')))!!}
    {!! Helper::textbox(array("colspan"=>3,"label"=>"Date","name"=>"date","placeholder"=>"Enter Date","class"=>"validate[required]","required"=>"Yes","typ"=>"date","value"=>old('date')))!!}   
    {!! Helper::textbox(array("colspan"=>5,"label"=>"Alternate Locations","name"=>"locname","placeholder"=>"If Multiple Locations","class"=>"","value"=>old('locname')))!!}    
  </div>
  {!! Helper::textbox(array("colspan"=>12,"label"=>"Notes","name"=>"notes","placeholder"=>"Enter Notes","class"=>"validate[required]","required"=>"Yes","typ"=>"HTML","value"=>old('notes')))!!}
  
  {!! Helper::close("form")!!}
  {!! Helper::closePage() !!}
@endsection
@section('myscript')
<script>
var imgSize=0;
var maxFileLimit = 2 * 1024 * 1024; //2MB Max Size
$('#cover_img').bind('change', function() {
  imgSize = this.files[0].size;
});
$("#frm").submit(function(event){
  if(imgSize > maxFileLimit)
  {
    alert("Invalid Image Size");
    event.preventDefault();  
  }
  return;
});
</script>
@endsection
