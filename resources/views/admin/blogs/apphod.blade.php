@extends('layouts/contentLayoutMaster')
@section('title', 'Learning')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>""))!!}
    {!! Helper::form(array("name"=>"frm","action"=>"admin/blogs/assign-hod","validate"=>"Yes"))!!}
    {!! Helper::hidden(array("name"=>"id","value"=>$id))!!}
    <div class="row">
        <div class="col-md-12">
            {!! Helper::button(array("name"=>"btnSave","label"=>"Assign to HOD","type"=>"submit","class"=>"btn btn-primary"))!!}
        </div>
    </div>
    <div class="row">
        {!! Helper::display(array("colspan"=>9,"label"=>"Subject","name"=>"subject","value"=>$blogs['subject'])) !!}
       {!! Helper::display(array("colspan"=>3,"name"=>"author","label"=>"Author","value"=>$blogs['authorname'])) !!}
    </div>
    {!! Helper::selectList(array("label"=>"Select HOD","colspan"=>12,"name"=>"hod","class"=>"validate[required]","options"=>$lstUsers,"key"=>"id","val"=>"name","blanks"=>"Yes"))!!}
   {!! Helper::textbox(array("label"=>"Comments","colspan"=>12,"name"=>"comments","class"=>"validate[required]","typ"=>"TEXTAREA"))!!}
   <div class="row">
    {!! Helper::textbox(array("label"=>"Exp. Closing Date","colspan"=>4,"name"=>"exp_closing_date","class"=>"validate[required]","typ"=>"DATE"))!!}
</div>
    {!! Helper::close("form")!!}
    {!! Helper::closePage()!!}

 
@endsection
@section('myscript')
  <script>
       
    </script>
@endsection
