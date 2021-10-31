@extends('layouts/contentLayoutMaster')
@section('title', 'FAQ')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
  {!! Helper::form(array("name"=>"frm","action"=>"admin/faq/view")) !!}
  {!! Helper::hidden(array("name"=>"action","value"=>"view"))!!}
  {!! Helper::hidden(array("name"=>"id","value"=>""))!!}
  {!! Helper::linkButton(array("colspan"=>12,"url"=>url('admin/faq/add'),"label"=>"Add FAQ","class"=>"btn-primary btnAdd")) !!} 
  <div class="row">
    <div class="col-md-12">
      <div class="table responsive">
        <table class="table table-striped dataex-html5-selectors">
          <thead>
            <tr>
              <th width='70%'>Question</th>
              <th width="20%">Category</th>
              <th>Author</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach($results as $row):
              $status = ($row['status'] == 0 ? "Active" : "Suspend");
              $url = "<a href='".url('admin/faq/view/'.$row['id'])."'>".$row['question']."</a>";
            ?>
            <tr>
              <td>{!! $url !!}</td>
              <td>{!! $row['categoryname'] !!}</td>
              <td>{!! $row['authorname'] !!}</td>
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