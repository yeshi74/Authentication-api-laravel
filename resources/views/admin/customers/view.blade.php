@extends('layouts/contentLayoutMaster')
@section('title', 'Customer Details')
@section('content')
{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
<div class="row">
    <?php
        // Helper::linkButton(array("colspan"=>3,"label"=>"Edit Customer","class"=>"btn-primary","link"=>"admin/customer/edit/".$id));
    ?>
</div>
<legend>Customer Details</legend>
<div class="row">
    {!! Helper::display(array("colspan"=>3,"label"=>"Name","value"=>$customer['name'])) !!}
    {!! Helper::display(array("colspan"=>3,"label"=>"Nationality","value"=>$customer['nationality'])) !!}
    {!! Helper::display(array("colspan"=>3,"label"=>"Mobile","value"=>$customer['mobile'])) !!}
    {!! Helper::display(array("colspan"=>3,"label"=>"Email","value"=>$customer['email'])) !!}
</div>
<div class="row">
    {!! Helper::display(array("colspan"=>3,"label"=>"Living Country","value"=>$customer->living_country)) !!}
    {!! Helper::display(array("colspan"=>3,"label"=>"Source","value"=>$customer->source)) !!}
    {!! Helper::display(array("colspan"=>3,"label"=>"Department","value"=>$customer->department)) !!}
    {!! Helper::display(array("colspan"=>3,"label"=>"Doctor","value"=>$customer->doctor)) !!}
</div>
<div class="row">
    {!! Helper::display(array("colspan"=>3,"label"=>"Receptionist","value"=>$customer['receptionist'])) !!}
    {!! Helper::display(array("colspan"=>3,"label"=>"Call center agent","value"=>$customer['call_center_agent'])) !!}
    {!! Helper::display(array("colspan"=>3,"label"=>"Date","value"=>$customer['date'])) !!}
    {!! Helper::display(array("colspan"=>3,"label"=>"Sales Team","value"=>$customer['sales_team'])) !!}
</div>
<div class="row">
    {!! Helper::display(array("colspan"=>3,"label"=>"Sales Man","value"=>$customer['sales_man'])) !!}
</div>

{!! Helper::closeResponsiveTable()!!}
 
 

<?php
Helper::closePage();
?>
@endsection
@section('myscript') 
 
@endsection