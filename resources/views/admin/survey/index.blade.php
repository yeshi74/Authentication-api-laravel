@extends('layouts/contentLayoutMaster')
@section('title', 'Evaluation Forms')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
  {!! Helper::form(array("name"=>"frm","action"=>"admin/survey/view")) !!}
  {!! Helper::hidden(array("name"=>"action","value"=>"view"))!!}
  {!! Helper::hidden(array("name"=>"id","value"=>""))!!}
  {!! Helper::linkButton(array("colspan"=>12,"url"=>url('admin/survey/add'),"label"=>"Add Evaluation Form","class"=>"btn-primary btnAdd")) !!} 
  <div class="row">
    <div class="col-md-12">
      <div class="table responsive">
          <table class="table table-striped dataex-html5-selectors">
            <thead>
              <tr>
                <th>Name</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach($results as $row):
                $status = $row['status'] == 0 ? "Active" : "Suspend";
                $_id = $row['id'];
                $url = "<a href ='".url('admin/survey/view/'.$row['id'])."'>".$row['name']."</a>";
              ?>
              <tr>
                <td>{!! $url !!}</td>
                <td>{!! $status !!}</td>
              </tr>
              <?php
                endforeach;
              ?>
            </tbody>
           </table>
      </div>
  </div>
  </div>
  {!! Helper::close("form")!!}
  {!! Helper::closePage() !!}
@endsection