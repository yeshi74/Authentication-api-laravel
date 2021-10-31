
@extends('layouts/contentLayoutMaster')
@section('title', 'Incidents')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>""))!!}
    {!!Helper::form(array("name"=>"frm","action"=>"admin/incidents/assign-update","validate"=>"Yes"))!!}
    {!!Helper::hidden(array("name"=>"id","value"=>$id))!!}
    {!!Helper::hidden(array("name"=>"action","value"=>""))!!} 
    @php
        $results = $output['results'];
    @endphp
    <div class="row">
        <div class="col-md-8">
            {!! Helper::button(array("label"=>"Assign Incident to User","name"=>"btnUpdate","type"=>"submit"))!!}
        </div>
             
        
        <div class="col-md-4">
            <span class="badge badge-{{$results['color']}}" style="float:right;">{{$results['statusname']}}
           
            </span>
            <br/><span style="float:right;">Reported on {{date('d/m/Y H:i',strtotime($results['incident_date']))}}</span>
            <br/><span style="float:right;">Last Updated on {{date('d/m/Y H:i',strtotime($results['updated_at']))}}</span>
        </div>
    </div>
    <hr/>
    <div class="row">
        {!! Helper::selectList(array("colspan"=>4,"label"=>"HOD","name"=>"userid","options"=>$lstHOD,"key"=>"id","val"=>"username","value"=>""))!!}
        {!! Helper::textbox(array("colspan"=>4,"label"=>"Expected Closing Date","typ"=>"date","name"=>"exp_closing","required"=>"Yes"))!!}
    </div>
   
    {!! Helper::textbox(array("colspan"=>12,"label"=>"Notes","name"=>"notes","placeholder"=>"Enter Notes","typ"=>"textarea","class"=>" validate[required]","required"=>"Yes","value"=>""))!!}
    {!!Helper::close("form")!!}
    @include('admin/incidents/details')
    
      
    
    {!! Helper::closePage()!!}
@endsection
@section('myscript')
<script>
  
    $(".lnkTrackView").on('click',function(){
        var id = $(this).data("id");
        var uURL = '{{url("admin/incidents/track-view/")}}';
        $.ajax({
              url: uURL + "/" + id,
              type: 'GET',
              success: function (data) {
                $("#modalTaskContents").html(data);
                $("#mTask").modal('show');
              }
          });
    });
</script>
@endsection







