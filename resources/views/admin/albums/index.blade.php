@extends('layouts/contentLayoutMaster')
@section('title', 'Albums')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
    {!! Helper::form(array("name"=>"frm","action"=>"admin/albums/view")) !!}
    {!! Helper::hidden(array("name"=>"action","value"=>"view"))!!}
    {!! Helper::hidden(array("name"=>"id","value"=>""))!!}
  <div class="row">
    <div class="col-md-12">
      {!! Helper::linkButton(array("url"=>url('admin/albums/add'),"label"=>"Add an Album","class"=>"btn-primary")) !!}
      @if($data['new'] != 0)
        {!! Helper::linkButton(array("url"=>url('admin/albums/for-approval'),"label"=>$data['new']." Albums for Approval","class"=>"btn-primary")) !!}
      @endif
    </div>
  </div>
{!! Helper::responsiveTableEx(array("Date","Title","Submitted By","Location","Status"))!!}
 
              <?php
                foreach($results as $row):
                $url = "<a href='".url('admin/albums/view/'.$row['id'])."'>".$row['subject']."</a>";
              ?>
              <tr>
                <td data-sort="{{ strtotime($row['cdate'])}}">{{ date('d/m/Y',strtotime($row['cdate'])) }}</td>
                <td>{!! $url !!}</td>
                <td>{!! $row['authorname'] !!}</td>
                <td>{!! $row['locname'] !!}</td>
                <td>{!! $row['statusname'] !!}</td>
              </tr>
              <?php
                endforeach;
              ?>
            {!! Helper::closeResponsiveTable()!!}
  {!! Helper::close("form")!!}
  {!! Helper::closePage() !!}
 
@endsection

@section('myscript')

@endsection
