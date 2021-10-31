<?php
    use App\Helpers\ApolloHelpers;
?>
@extends('layouts/contentLayoutMaster')
@section('title', 'Communications')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>""))!!}
    {!! Helper::form(array("name"=>"frm","action"=>"admin/newsletters/edit","validate"=>"Yes"))!!}
    {!! Helper::hidden(array("name"=>"action","value"=>"edit"))!!}
    {!! Helper::hidden(array("name"=>"id","value"=>$id))!!}

    <div class="row">
        {!! Helper::linkButton(array("colspan"=>2,"url"=>url('admin/newsletters/edit/'.$id),"btnEdit","label"=>"Edit","type"=>"submit","class"=>"btn btn-primary","data"=>array("action"=>"edit")))!!}
        {!! Helper::button(array("colspan"=>2,"name"=>"btnDelete","label"=>"Delete","type"=>"button","class"=>"btnAction btn-danger","data"=>array("action"=>"delete")))!!}
    </div>
                
    <div class="row">
        <?php
            $status=($results['status'] == 0 ? "Active" : "Suspend");
            $date=date('d/m/Y',strtotime($results['period']));
        ?>
        {!! Helper::display(array("colspan"=>4,"label"=>"Subject","name"=>"subject","value"=>$results['subject']))!!}
        {!! Helper::display(array("colspan"=>3,"name"=>"period","label"=>"Period","value"=>$date))!!}
        {!! Helper::display(array("colspan"=>2,"name"=>"status","label"=>"Status","value"=>$status))!!}
        {!! Helper::display(array("colspan"=>3,"name"=>"period","label"=>"Is Public","value"=>$results['is_public'] == 0 ? "No" : "Yes"))!!}
    </div> 
    <br/>
        {!! Helper::display(array("colspan"=>12,"name"=>"summary","label"=>"Summary","value"=>$results['summary'],"required"=>"Y","class"=>"textarea validate[required]"))!!}
        
        {{-- {!! Helper::attachment(array("colspan"=>4,"label"=>"NewsLetter Attachment","id"=>$results['id'],"module"=>"NEWSLETTERS","value"=>$results['file'])) !!} --}}
       <div class="accordion" id="accView">
    {!! Helper::accordion(array("id"=>"c0","parent"=>"accView","label"=>"Attachment"))!!}
    @if($results['typ']=="PDF")
            <h6>NewsLetter Attachment</h6>
            {!! Helper::gallery(array("module"=>"NEWSLETTERS","id"=>$id,"mode"=>"VIEW")) !!}
        @endif
         @if($results['typ']=="VIDEO")
            <h6>NewsLetter Video</h6>
            <iframe src="https://youtube.com/embed/{{$results['video']}}?rel=0" width="100%" frameborder=0 height="350px;"></iframe>
        @endif
    {!! Helper::closeAccordion() !!}
    {!! Helper::accordion(array("id"=>"c2","parent"=>"accView","label"=>"Locations"))!!}
    <?php echo ApolloHelpers::locationTree(array("name"=>"locations","mode"=>"VIEW","selLocations"=>$lstLocations,"selRoles"=>$lstRoles)); ?>
    {!! Helper::closeAccordion() !!}
    {!! Helper::accordion(array("id"=>"c3","parent"=>"accView","label"=>"Users"))!!}
      {!! Helper::responsiveTable(array("Name","Emp. Code","Location"))!!}
      @foreach($lstUsers as $row)
        <tr>
          <td>{!!$row['name']!!}</td>
          <td>{!!$row['empcode']!!}</td>
          <td>{!!$row['location']!!}</td>
        </tr>
      @endforeach
      {!! Helper::closeResponsiveTable()!!}
    {!! Helper::closeAccordion() !!}   
   
  </div>
    {!! Helper::close("form")!!}
    {!! Helper::closePage()!!}
@endsection

@section('myscript')
    <script>
        var url = "{{url('admin/newsletters/')}}";
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






