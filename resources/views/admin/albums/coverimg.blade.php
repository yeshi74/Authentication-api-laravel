@extends('layouts/contentLayoutMaster')
@section('title', 'Albums')
@section('content')
<?php
  if($typ=="APPROVE"):?>
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
<?php endif; ?>
{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
{!! Helper::form(array("name"=>"frm","action"=>"admin/albums/coverimg/update","validate"=>"Yes"))!!}
{!! Helper::hidden(array("name"=>"id","value"=>$id))!!}

<div class="row">
    <div class="col-md-12">
        {!! Helper::button(array("name"=>"btnUpdate","label"=>"Update","type"=>"submit","class"=>"btn btn-primary"))!!}
    </div>
  
</div>


<div class="row">
    <div class="col-md-12">
        <h4>{{$results['subject']}}</h4>
    </div>
</div>
        
  
{!! Helper::gallery(array("module"=>"ALBUMS","id"=>$id,"mode"=>"SET","img"=>$results['img']))!!}
{!! Helper::close("form") !!}
{!! Helper::closePage() !!}
@endsection
@section('myscript')
<script>
 var url = "{{url('admin/albums/')}}";
   
    
</script>
@endsection