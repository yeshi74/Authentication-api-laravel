@extends('layouts/contentLayoutMaster')
@section('title', 'pages Details')
@section('content')
{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
<div class="row">
    <?php
        // Helper::linkButton(array("colspan"=>3,"label"=>"Edit pages","class"=>"btn-primary","link"=>"admin/pages/edit/".$id));
    ?>
</div>
<legend>Pages Details</legend>
<div class="row">
    {!! Helper::display(array("colspan"=>3,"label"=>"Page Code","value"=>$pages['page_code'])) !!}
    {!! Helper::display(array("colspan"=>3,"label"=>"Header","value"=>$pages['header'])) !!}
</div>
<div class="row">
    {!! Helper::display(array("colspan"=>6,"label"=>"Body","name"=>"body","typ"=>"HTML","value"=>$pages->body)) !!}
</div>

{!! Helper::closeResponsiveTable()!!}
 
 

<?php
Helper::closePage();
?>
@endsection
@section('myscript') 
 
@endsection