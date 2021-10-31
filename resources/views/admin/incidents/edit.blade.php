
@extends('layouts/contentLayoutMaster')
@section('title', 'Incidents')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>""))!!}
    {!!Helper::form(array("name"=>"frm","action"=>"admin/incidents/update","validate"=>"Yes"))!!}
    {!!Helper::hidden(array("name"=>"id","value"=>$id))!!}
    <div class="row">
        <div class="col-md-6">
            {!! Helper::button(array("label"=>"Update Incident","name"=>"btnEdit","type"=>"submit")) !!}
        </div>
        <div class="col-md-3">
            <h5>Reported on {{date('d/m/Y',strtotime($results['created_at']))}}</h5>
        </div>
        <div class="col-md-3">
            <h5 style="float:right;">{{$results['statusname']}}
            @if($results['status']==20)
                <strong>on {{date('d/m/Y',strtotime($results['closed_at']))}}</strong>
            @endif
            </h5>
        </div>
    </div>
    <div class="row">
        <?php
            $date=date('d/m/Y',strtotime($results['incident_date']));
        ?>
        {!!Helper::display(array("colspan"=>3,"label"=>"Employee ID","name"=>"uhid","value"=>$results['uhid']))!!}
        {!!Helper::display(array("colspan"=>3,"label"=>"Party Name","name"=>"party_name","value"=>$results['party_name']))!!}
        {!!Helper::display(array("colspan"=>2,"name"=>"period","label"=>"Period","value"=>$date))!!}
        {!!Helper::display(array("colspan"=>2,"label"=>"Gender","name"=>"gender","value"=>$results['gender']))!!}
        {!!Helper::display(array("colspan"=>2,"label"=>"Age","name"=>"age","value"=>$results['age']))!!}

    </div>
    <div class="row">

        {!!Helper::display(array("colspan"=>3,"name"=>"BU","label"=>"BU Name","value"=>$results['buname']))!!}
        {!!Helper::display(array("colspan"=>3,"name"=>"center","label"=>"Center","value"=>$results['center']))!!}
        {!!Helper::display(array("colspan"=>3,"label"=>"Place of Occurence","value"=>$results['place_occurence']))!!}
        {!!Helper::display(array("colspan"=>3,"name"=>"identification","label"=>"Identification","value"=>$results['identification']))!!}
    </div>
    <div class="row">
        <div class="col-md-12">
            <strong>Notifications</strong><br>
       <div class="row">
       @foreach($lstNotifications as $row)
        <div class="col-md-3"><label>{{$row['name']}}</div>
       @endforeach
   </div>
</div>
    </div><br/>
    {!!Helper::display(array("colspan"=>12,"label"=>"Incident Severity","name"=>"incident_sev","value"=>$results['incident_sev']))!!}
    <fieldset>
        <legend>QA Comments</legend>
        <div class="row">
            {!!Helper::select(array("colspan"=>3,"label"=>"Probability","value"=>$results['probability'],"name"=>"probability","options"=>array("Frequent"=>"Frequent","Occasional"=>"Occasional","Uncommon"=>"Uncommon","Remote"=>"Remote"))) !!}
            {!!Helper::select(array("colspan"=>3,"label"=>"Severity","value"=>$results['severity'],"name"=>"severity","options"=>array("Severe"=>"Severe","Major"=>"Major","Moderate"=>"Moderate","Minor"=>"Minor"))) !!}
            {!!Helper::select(array("colspan"=>3,"label"=>"Score","value"=>$results['score'],"name"=>"score","options"=>array("1"=>1,"2"=>2,"3"=>3))) !!}
            {!!Helper::selectList(array("colspan"=>3,"label"=>"Category","value"=>$results['category'],"name"=>"category","options"=>$lstIncidentsCategory,"key"=>"id","val"=>"name")) !!}
        </div>
        {!!Helper::selectList(array("colspan"=>12,"label"=>"Expected Outcome","value"=>$results['exp_outcome'],"name"=>"exp_outcome","options"=>$lstOutcome,"key"=>"id","val"=>"name","required"=>"Y","class"=>"validate[required]")) !!}
        {!!Helper::textbox(array("colspan"=>12,"label"=>"Comments","value"=>$results['qa_comments'],"name"=>"qa_comments","typ"=>"HTML","required"=>"Y","class"=>"validate[required]")) !!}
    </fieldset>
    <div class="accordion" id="accView">
    {!! Helper::accordion(array("id"=>"c0","parent"=>"accView","label"=>"Events"))!!}
    @include('admin/incidents/viewEvents')
    {!! Helper::closeAccordion() !!}
    {!! Helper::accordion(array("id"=>"c1","parent"=>"accView","label"=>"Details"))!!}
        @foreach($lstDetails as $row)
            <h6>{{$row['name']}}</h6><br>
            <p>{!! $row['details'] !!}</p>
        @endforeach
    {!! Helper::closeAccordion() !!}
  
    {!! Helper::accordion(array("id"=>"c5","parent"=>"accView","label"=>"Tracker"))!!}
     <div class="row">
                <div class="col-md-12">
                    <div class="table responsive">
                        <table class="table table-striped dataex-html5-selectors">
                            <thead>
                                <tr>
                                  <th>Assigned To</th>
                                  <th>Date</th>
                                  <th>Assigned By</th>
                                  <th>Closed Date</th>
                                  <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach($lstLogs as $row):
                                ?>
                                <tr>
                                  <td>{!! $row['assigned_to_name'] !!}</td>
                                  <td data-sort="{{ strtotime($row['created_at'])}}">{{ date('d/m/Y',strtotime($row['created_at'])) }}</td>
                                  <td>{!! $row['assigned_by_name'] !!}</td>
                                  <td>{!! $row['closed_date'] !!}</td>
                                  <td>{!! $row['status_name'] !!}</td>
                                </tr>
                                <?php
                                  endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    {!! Helper::closeAccordion() !!}
     {!! Helper::accordion(array("id"=>"c5","parent"=>"accView","label"=>"Attachments"))!!}
    {!! Helper::gallery(array("module"=>"INCIDENTS","id"=>$id,"mode"=>"VIEW"))!!}

    {!! Helper::closeAccordion() !!}
    </div>
    {!!Helper::close("form")!!}
     <div class="modal fade text-left" id="modalAssign" tabindex="-1" role="dialog" aria-labelledby="myAddBUlabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myAddBUlabel">Assign to User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!!Helper::form(array("name"=>"frm","action"=>"admin/incidents/assign","validate"=>"Yes"))!!}
                {!!Helper::hidden(array("name"=>"id","id"=>"hdfBUID","value"=>$id))!!}

                <div class="modal-body">
                    {!! Helper::selectList(array("colspan"=>12,"label"=>"User","name"=>"userid","options"=>$lstUsers,"key"=>"id","val"=>"name","value"=>""))!!}
                    {!! Helper::textbox(array("colspan"=>12,"label"=>"Notes","name"=>"notes","placeholder"=>"Enter Notes","typ"=>"textarea","class"=>" validate[required]","required"=>"Yes","value"=>""))!!}
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                {!! Helper::close("form") !!}
            </div>
        </div>
    </div>
    {!! Helper::closePage()!!}
@endsection
@section('myscript')
<script>
    $("#btnAssign").on('click',function(){

        $("#modalAssign").modal('show');
    });
    $("#btnClose").on('click',function(){
        if(confirm("Do you want to close this incident?")){
            $("#frm").submit();
        }
    });
    $("#btnEdit").on('click',function(){
        var pURL = '{{url("admin/incidents/edit/{$id}")}}';
        location.href = pURL;
    });
</script>
@endsection







