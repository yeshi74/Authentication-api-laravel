@extends('layouts/contentLayoutMaster')
@section('title', 'Albums')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
  {!! Helper::form(array("name"=>"frm","action"=>"admin/albums/update","validate"=>"Yes"))!!}
  {!! Helper::hidden(array("name"=>"action","value"=>"update"))!!}
  {!! Helper::hidden(array("name"=>"id","value"=>$id))!!}
  {!! Helper::button(array("colspan"=>12,"name"=>"btnUpdate","label"=>"Update","type"=>"submit")) !!}
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
    {!!Helper::textbox(array("colspan"=>8,"label"=>"Subject","name"=>"subject","placeholder"=>"Enter Subject","class"=>"validate[required]","value"=>$results['subject'],"max"=>150))!!}
    {!! Helper::listLocations(array("colspan"=>4,"label"=>"Location","name"=>"location","multiple"=>"No","blank"=>"Yes","value"=>$results['location']))!!}
  </div>
  <div class="row">
    {!!Helper::selectList(array("colspan"=>4,"label"=>"Submitted By","name"=>"author","options"=>$getAuthor,"value"=>"","key"=>"id","val"=>"name","value"=>$results['author']))!!}
    {!!Helper::textbox(array("colspan"=>3,"label"=>"Date","name"=>"date","placeholder"=>"Enter Date","class"=>"validate[required]","typ"=>"date","value"=>$results['date']))!!}
    {!!Helper::textbox(array("colspan"=>8,"label"=>"Alternate Locations","name"=>"locname","placeholder"=>"Multiple Locations","class"=>"","value"=>$results['locname'],"max"=>150))!!}
  </div>
   
  
  {!! Helper::textbox(array("colspan"=>12,"label"=>"Notes","name"=>"notes","placeholder"=>"Enter Notes","class"=>"validate[required]","typ"=>"HTML","value"=>$results['notes']))!!}
  {!! Helper::close("form")!!}
  {!! Helper::gallery(array("module"=>"ALBUMS","id"=>$id,"mode"=>"EDIT"))!!}


{!! Helper::closePage() !!}
 
@endsection
@section('myscript')
 
@endsection


 