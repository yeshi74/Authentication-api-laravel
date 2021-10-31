<?php
    use App\Helpers\ApolloHelpers;
    $statusName = $results['status'] == 0 ? "Active" : "Suspend";
?>
@extends('layouts/contentLayoutMaster')
@section('title', 'Q4e Forms')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
    <div class="row">
        <div class="col-md-10">
            <h4>{{$results['name']}} <span class="title">({{$results['typname']}})</span></h4>
        </div>
        <div class="col-md-2">
            {{$statusName}}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            {!! Helper::linkButton(array("url"=>url('admin/q4eforms/'.$ftype.'/edit/'.$id),"label"=>"Edit","class"=>"btn btn-primary","data"=>array("action"=>"edit")))!!}
            <!-- {!! Helper::linkButton(array("url"=>url('admin/q4eforms/'.$ftype.'/preview/'.$id),"label"=>"Preview","class"=>"btn btn-primary","target"=>"_new"))!!}
            {!! Helper::linkButton(array("url"=>url('admin/q4eforms/'.$ftype.'/reports/'.$id),"label"=>"Reports","class"=>"btn btn-danger"))!!} -->
            {!! Helper::linkButton(array("url"=>url('admin/q4eforms/'.$ftype.'/assign/'.$id),"label"=>"Assignments","class"=>"btn btn-primary"))!!}
            {!! Helper::linkButton(array("url"=>url('admin/q4eforms/'.$ftype.'/assign-now/'.$id),"label"=>"Assign Now","class"=>"btn btn-danger"))!!}
           <!-- {!! Helper::linkButton(array("url"=>url('admin/q4eforms/'.$ftype.'/sample/'.$id),"label"=>"Generate Notifications","class"=>"btn btn-danger"))!!} -->
        </div>
    </div>
   
    <div class="row">
        {!! Helper::display(array("colspan"=>3,"label"=>"Frequency","value"=>$results['frequency'])) !!}
        {!! Helper::display(array("colspan"=>3,"label"=>"Results Type","value"=>$results['results_typ'])) !!}
        {!! Helper::display(array("colspan"=>3,"label"=>"Days to Submit","value"=>$results['days_submit'])) !!}
        {!! Helper::display(array("colspan"=>3,"label"=>"Owner","value"=>$results['ownername'])) !!}
    </div>
    <div class="row">
        <?php 
            $c="";
            if($results['color'] != ""){
                $c = "fbg-".$results['color'];
            }
        ?>
        <div class="col-md-3">
            <label>Color</label>
            <div class=" {{$c}}">&nbsp;<br/></div>
        </div>
        <?php 
            $icon="";
            if($results['icon'] != ""){
                $icon = "<img src='".$imgPath.$results['icon'].".png' height='100px'/>";
            }
        ?>
        <div class="col-md-3">
            <label>Icon</label><br/>
            {!! $icon !!}
        </div>
        @if($results->typcode=="OUTCOME" || $results->typcode=="CHECKLIST")
            {!! Helper::display(array("colspan"=>3,"label"=>"Max Value for Scoring","value"=>$results['max_val']))!!}
        @endif
    </div>
    <div class="row" style="margin-bottom:10px;">
        <div class="col-md-6">
            <label>Applicable to BU</label><br/>
            @foreach($lstApplicableBU as $row)
                {{$row->name}}&nbsp;
            @endforeach
        </div>
    
    @if($results['frequency'] == "Quarterly")
            <div class="col-md-6">
                <label>Run on Months</label><br/>
                <?php  
                foreach($lstMonths as $m) {
                  // print_r($m);
                //    echo "<hr>";
                //    echo $m['name'];
                echo $m."&nbsp;";
                }?>
                {{-- @foreach($lstMonths as $m)
                {{$m->name}} &nbsp;
                @endforeach --}}
            </div>
    @endif
</div>
    <div class="accordion" id="accView">
        {!! Helper::accordion(array("id"=>"c0","parent"=>"accView","label"=>"Messages")) !!}
            {!! Helper::display(array("colspan"=>12,"label"=>"Header","value"=>$results['header'])) !!}
            {!! Helper::display(array("colspan"=>12,"label"=>"Footer","value"=>$results['footer'])) !!}
            {!! Helper::display(array("colspan"=>12,"label"=>"Message for Assignment","value"=>$results['assign_msg'])) !!}
            {!! Helper::display(array("colspan"=>12,"label"=>"Reminder Message","value"=>$results['reminder_msg'])) !!}
            {!! Helper::display(array("colspan"=>12,"label"=>"Complete Message","value"=>$results['complete_msg'])) !!}
            {!! Helper::display(array("colspan"=>12,"label"=>"Thank You Message","value"=>$results['thankyou_msg'])) !!}
        {!! Helper::closeAccordion() !!}
        {!! Helper::accordion(array("id"=>"c1","parent"=>"accView","label"=>"Locations/Roles")) !!}
            <?php echo ApolloHelpers::locationTree(array("name"=>"locations","mode"=>"VIEW","selLocations"=>$lstLocations,"selRoles"=>$lstRoles)); ?>
        {!! Helper::closeAccordion() !!}
        {!! Helper::accordion(array("id"=>"c2","parent"=>"accView","label"=>"Sections")) !!}
            {!! Helper::linkButton(array("url"=>url('admin/q4eforms/'.$ftype.'/section/add/'.$id),"btnEdit","label"=>"Add New Section","class"=>"btn btn-primary"))!!}
            <ol>
                @foreach($lstSections as $row)
                    <li><a href="{{url('admin/q4eforms/'.$ftype.'/section/view/'.$id.'/'.$row['id'])}}">{{$row['name']}} ({{$row['cnt']}} Items)</a></li>
                @endforeach
            </ol>
        {!! Helper::closeAccordion() !!}
        {!! Helper::accordion(array("id"=>"c2a","parent"=>"accView","label"=>"Properties")) !!}
            <table class="table table-stripped">
            @foreach($lstProps as $row)
                <tr>
                    <td>{{$row['prop']}}</td>
                    <td>{{$row['val']}}</td>
                </tr>
            @endforeach
            </table>
        {!! Helper::closeAccordion() !!}
    </div>

    {!! Helper::closePage()!!}
@endsection
@section('myscript')
@endsection
