@extends('layouts/contentLayoutMaster')
@section('title', 'Locations')
@section('content')
{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
<div class="row">
    {!! Helper::display(array("colspan"=>3,"label"=>"Clinic Code","value"=>$a['clinic_code']))!!}
    {!! Helper::display(array("colspan"=>3,"label"=>"Name","value"=>$a['name']))!!}
    {!! Helper::display(array("colspan"=>3,"label"=>"Region","value"=>$a['region']))!!}
    {!! Helper::display(array("colspan"=>3,"label"=>"BU","value"=>$a['bu']))!!}
</div>
<div class="row">
    {!! Helper::display(array("colspan"=>3,"label"=>"Center Head","value"=>$a['centerHead']))!!}
    {!! Helper::display(array("colspan"=>3,"label"=>"BU Head","value"=>$a['buHead']))!!}
    {!! Helper::display(array("colspan"=>3,"label"=>"COO Name","value"=>$a['cooName']))!!}
    {!! Helper::display(array("colspan"=>3,"label"=>"CEO Name","value"=>$a['ceoName']))!!}
</div>
<div class="row">
    {!! Helper::display(array("colspan"=>3,"label"=>"HOQ Name","value"=>$a['hoqName']))!!}
    {!! Helper::display(array("colspan"=>3,"label"=>"Status","value"=>$a['statusName']))!!}
</div>
 
{!! Helper::responsiveTable(array("Type","Survey Forms"))!!}
@foreach($lstForms as $row)
   <tr>
       <td>{{$row->fname}}</td>
       <td><a href="{{url('admin/q4eforms/'.$row->url.'/view/'.$row->id)}}">{{$row->name}}</a></td> 
   </tr>
@endforeach
{!! Helper::closeResponsiveTable()!!}
    {!! Helper::closePage()!!}
</section>
@endsection

@section('myscript')
   
@endsection
