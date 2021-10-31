@extends('layouts/contentLayoutMaster')
@section('title', 'Category')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
  <?php $status = $results['status'] == 0 ? "Active" : "Suspended"; ?>
  <div class="row">
    <div class="col-md-12">
    {!! Helper::linkButton(array("url"=>url('admin/category/edit/'.$id),"btnEdit","label"=>"Edit","type"=>"submit","class"=>"btn btn-primary","data"=>array("action"=>"edit")))!!}
   </div>
  </div>

  <div class="row">
   
    {!! Helper::display(array("colspan"=>4,"label"=>"Cateory Name","name"=>"category","value"=>$results['name'])) !!}
    {!! Helper::display(array("colspan"=>4,"label"=>"Parent Category","name"=>"parent","value"=>$results['parentname'])) !!}
    {!! Helper::display(array("colspan"=>4,"label"=>"Status","value"=>$status)) !!}
  </div>

  
  {!! Helper::display(array("colspan"=>12,"name"=>"summary","value"=>$results['summary'],"label"=>"Summary"))!!}
  {!! Helper::closePage() !!}
@endsection

@section('myscript')
  <script>
    var url = "{{url('admin/category/')}}";
      $(".btnAction").on('click',function(){
        var action = $(this).data("action");
        $("#action").val(action);
        if(confirm("Are you sure you want to perform this action?"))
        {
          var pURL = url + "/" + action;
          $('#frm').attr('action', pURL).submit();
        }
      });
  </script>
@endsection