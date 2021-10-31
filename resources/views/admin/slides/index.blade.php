@extends('layouts/contentLayoutMaster')
@section('title', 'Slides')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
    {!! Helper::form(array("name"=>"frm","action"=>"admin/albums/view")) !!}
    {!! Helper::hidden(array("name"=>"action","value"=>"view"))!!}
    {!! Helper::hidden(array("name"=>"id","value"=>""))!!}
  <div class="row">
    <div class="col-md-12">
      {!! Helper::linkButton(array("url"=>url('admin/slides/add'),"label"=>"Add Slide","class"=>"btn-primary")) !!}
    </div>
  </div>

  <div class="row">
      <div class="col-md-12">
        <div class="table responsive">
          <table class="table table-striped dataex-html5-selectors">
            <thead>
              <tr>
                <th>Title</th>
                <th>Type</th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach($lstSlides as $row):
                $url = "<a href='".url('admin/slides/view/'.$row['id'])."'>".$row['title']."</a>";
              ?>
              <tr>
                <td>{!! $url !!}</td>
                <td>{!! $row['typ'] !!}</td>
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

@section('myscript')

@endsection
