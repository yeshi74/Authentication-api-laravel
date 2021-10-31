<?php
    use App\Helpers\ApolloHelpers;
?>
@extends('layouts/contentLayoutMaster')
@section('title', 'Training')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
    {!! Helper::form(array("name"=>"frm","action"=>"admin/training/edit","validate"=>"Yes"))!!}
    {!! Helper::hidden(array("name"=>"action","value"=>"edit")) !!}
    {!! Helper::hidden(array("name"=>"id","value"=>$id))!!}
    <div class="row">
        <div class="col-md-10">
            {!! Helper::linkButton(array("url"=>url('admin/training/edit/'.$id),"label"=>"Edit","class"=>"btn btn-primary"))!!}
            {!! Helper::button(array("name"=>"btnDelete","label"=>"Delete","type"=>"button","class"=>"btnAction btn btn-danger","data"=>array("action"=>"delete")))!!}
            @if($results['beforeSurveyName'] != "" || $results['afterSurveyName'] != "")
                {!! Helper::button(array("name"=>"btnExport","label"=>"Export Results","type"=>"button","class"=>"btn btn-warning"))!!}
            @endif
            @if($results['publish'] == 0)
                {!! Helper::button(array("name"=>"btnPublish","label"=>"Publish","type"=>"button","class"=>"btnAction btn btn-warning","data"=>array("action"=>"publish")))!!}

            @endif
            {!! Helper::linkButton(array("url"=>url('admin/training/delay/'.$id),"label"=>"Delayed Trainings","class"=>"btn btn-primary"))!!}
        </div>
        <div class="col-md-2">
            @if($results['publish'] == 0)
                <strong>Not Published</strong>
            @else
                <strong>Published on {{date('d/m/Y',strtotime($results['publish_date']))}}</strong>
            @endif
        </div>
    </div>
    <?php
        $status = ($results['status'] == 0 ? "Active" : "Suspend");
        $startDate = date('d/m/Y H:i',strtotime($results['training_date'])); 
        $endDate = date('d/m/Y H:i',strtotime($results['training_edate'])); 
    ?>
    <div class="row">
        {!! Helper::display(array("colspan"=>6,"label"=>"Subject","name"=>"subject","value"=>$results['subject'])) !!}
        {!! Helper::display(array("colspan"=>3,"label"=>"Category","name"=>"category","value"=>$results['categoryname'])) !!}
        {!! Helper::display(array("colspan"=>3,"label"=>"Mode","name"=>"mode","value"=>$results['modename'])) !!}
    </div>
    <div class="row">
        {!! Helper::display(array("colspan"=>4,"label"=>"Start Date","name"=>"date","value"=>$startDate))!!}
        {!! Helper::display(array("colspan"=>4,"label"=>"End Date","name"=>"date","value"=>$endDate))!!}
        {!! Helper::display(array("colspan"=>4,"name"=>"period","label"=>"Is Public","value"=>$results['is_public'] == 0 ? "No" : "Yes"))!!}

    </div>
    {!! Helper::display(array("colspan"=>12,"label"=>"Location","name"=>"date","value"=>$results['location']))!!}
    <div class="row">
        {{-- {!! Helper::attachment(array("colspan"=>6,"label"=>"Attachment","id"=>$results['id'],"module"=>"TRAINING","value"=>$results['attachment'])) !!} --}}
        {!! Helper::display(array("colspan"=>3,"label"=>"Before Evaluation","name"=>"before_survey","value"=>$results['beforeSurveyName'])) !!}
        {!! Helper::display(array("colspan"=>3,"label"=>"After Evaluation","name"=>"after_survey","value"=>$results['afterSurveyName'])) !!}
        {!! Helper::display(array("colspan"=>3,"label"=>"Status","value"=>$status)) !!}
    </div>
    {!! Helper::display(array("colspan"=>12,"label"=>"URL, if online training","name"=>"date","value"=>$results['url']))!!}
    <br/>
    <div class="accordion" id="accView">
    {!! Helper::accordion(array("id"=>"c0","parent"=>"accView","label"=>"Summary"))!!}
    {!! Helper::display(array("colspan"=>12,"name"=>"summary","label"=>"","value"=>$results['summary']))!!}
    {!! Helper::closeAccordion() !!}
    {!! Helper::accordion(array("id"=>"c01","parent"=>"accView","label"=>"Details"))!!}
    {!! Helper::display(array("colspan"=>12,"name"=>"details","label"=>"","value"=>$results['details']))!!}
    {!! Helper::closeAccordion() !!}
    {!! Helper::accordion(array("id"=>"c1","parent"=>"accView","label"=>"Users Attending"))!!}
    {!! Helper::responsiveTable(array("Training","User","Status","Start Date","Complete Date","Last Attend","Before Evaluation","After Evaluation"))!!}
    @foreach($lstUsers as $row)
        <tr>
            <td>{{$results['subject']}}</td>
            <td>{{$row->username}}</td>
            <td>{{$row->statusName}}</td>
            <td>{{$row->fStartDate}}</td>
            <td>{{$row->fCompleteDate}}</td>
            <td>{{$row->fLastAttend}}</td>
            @if($results['beforeSurveyName'] != "" && $row->before_points != 0)
                <td><a href="{{url('admin/training/viewsurvey/before/'.$row['id'])}}">{{$row->before_points}}</a></td>
            @else
                <td></td>
            @endif
            @if($results['afterSurveyName'] != "" && $row->after_points != 0)
                <td><a href="{{url('admin/training/viewsurvey/after/'.$row['id'])}}">{{$row->after_points}}</a></td>
            @else
                <td></td>
            @endif
        </tr>
    @endforeach
    {!! Helper::closeResponsiveTable()!!}
    {!! Helper::closeAccordion() !!}
    {!! Helper::accordion(array("id"=>"c2","parent"=>"accView","label"=>"Locations/Roles"))!!}
    <?php echo ApolloHelpers::locationTree(array("name"=>"locations","mode"=>"VIEW","selLocations"=>$lstLocations,"selRoles"=>$lstRoles)); ?>
    {!! Helper::close("form")!!}
    {!! Helper::closeAccordion() !!}

    {!! Helper::accordion(array("id"=>"c3","parent"=>"accView","label"=>"Documents"))!!}
    {!! Helper::gallery(array("module"=>"TRAINING","id"=>$id,"mode"=>"VIEW"))!!}
     {!! Helper::closeAccordion() !!}
    {!! Helper::closePage() !!}
    {!! Helper::form(array("name"=>"frmExport","target"=>"_new","action"=>"admin/training/export/results","validate"=>"Yes"))!!}
    {!! Helper::hidden(array("name"=>"id","value"=>$id))!!}
    {!! Helper::close("form")!!}
@endsection

@section('myscript')
<script>
     var url = "{{url('admin/training/')}}";
    $(".btnAction").on('click',function(){
        var action = $(this).data("action");
        $("#action").val(action);
        if(confirm("Are you sure you want to perform this action?"))
        {
            var pURL = url + "/" + action;
            $('#frm').attr('action', pURL).submit();
        }
    });
    $("#btnExport").on('click',function(){
        $("#frmExport").submit();
    });
</script>
@endsection
