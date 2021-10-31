@extends('layouts/contentLayoutMaster')
@section('title', 'Incident Category')
@section('content')
 
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>"")) !!}
  
  
  <div class="row">
    <div class="col-md-12">
      {!! Helper::linkButton(array("colspan"=>2,"url"=>url('admin/incidents-category/edit/'.$id),"btnEdit","label"=>"Edit","type"=>"submit","class"=>"btn btn-primary","data"=>array("action"=>"edit")))!!}
    </div>
  </div>
  {!! Helper::display(array("colspan"=>12,"label"=>"Caption","value"=>$output['caption']))!!}
  <div class="row">
    
    {!! Helper::display(array("colspan"=>4,"label"=>"Category","value"=>$output['name']))!!}
    {!! Helper::display(array("colspan"=>4,"label"=>"Status","value"=>$output['status'] == 0  ? "Active" : "Suspended"))!!}
    
    {!! Helper::display(array("colspan"=>4,"label"=>"Type","value"=>$output['typ']))!!}
    
  </div>
  {!! Helper::closePage() !!}
@endsection

