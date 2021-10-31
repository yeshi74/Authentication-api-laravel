@extends('layouts/contentLayoutMaster')
@section('title', 'Survey')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>"")) !!}
  {!! Helper::form(array("name"=>"frm","action"=>"admin/survey/save","validate"=>"Yes")) !!}
  {!! Helper::hidden(array("name"=>"action","value"=>"save")) !!}
  {!! Helper::hidden(array("name"=>"id","value"=>"")) !!}
  {!! Helper::button(array("colspan"=>12,"name"=>"btnUpdate","class"=>"btn btn-primary btnAction","label"=>"Save","type"=>"submit"))!!}
  {!! Helper::textbox(array("colspan"=>12,"label"=>"Name","name"=>"name","max"=>150,"placeholder"=>"Enter Name","class"=>"validate[required]","required"=>"Yes","value"=>"")) !!}
<div class="row">
    
    {!! Helper::select(array("colspan"=>4,"label"=>"Type","name"=>"typ","value"=>"","options"=>array("Evaluation"=>"Evaluation"))) !!}
    {!! Helper::selectStatus(array("colspan"=>4,"label"=>"Status","name"=>"status","value"=>"")) !!}
    {!! Helper::textbox(array("colspan"=>4,"label"=>"Max. Points","name"=>"max_points","placeholder"=>"Enter Maximum Points","class"=>"validate[required]","required"=>"Yes","typ"=>"NUMBER","value"=>"")) !!}
</div>
    
  {!! Helper::close("form")!!}
  {!! Helper::closePage() !!}
@endsection
