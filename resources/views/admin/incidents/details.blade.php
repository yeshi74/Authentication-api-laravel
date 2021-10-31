<?php
    $lstLogs = $output['lstTasks'];
    $results = $output['results'];
    $lstCategory = $output['lstCategory'];
    $lstEvents = $output['lstEvents'];
?>
<div class="row">
    <div class="col-lg-12 col-sm-12">
        <div class="row">
            {!!Helper::display(array("colspan"=>3,"label"=>"Employee ID","name"=>"uhid","value"=>$results['uhid']))!!}
            {!!Helper::display(array("colspan"=>3,"label"=>"Party Name","name"=>"party_name","value"=>$results['party_name']))!!}
            {!!Helper::display(array("colspan"=>2,"label"=>"Gender","name"=>"gender","value"=>$results['gender']))!!}
            {!!Helper::display(array("colspan"=>2,"label"=>"Age","name"=>"age","value"=>$results['age']))!!}
            {!!Helper::display(array("colspan"=>2,"name"=>"identification","label"=>"Identification","value"=>$results['identification']))!!}
        </div>
        <div class="row">
            {!!Helper::display(array("colspan"=>3,"name"=>"BU","label"=>"BU Name","value"=>$results['buname']))!!}
            {!!Helper::display(array("colspan"=>3,"name"=>"center","label"=>"Center","value"=>$results['center']))!!}
            {!!Helper::display(array("colspan"=>6,"label"=>"Place of Occurence","name"=>"place_occurence","value"=>$results['place_occurence']))!!}

        </div>
        <div class="row">
            <div class="col-md-12"><label>Notifications</label>
                <div class="row">
                   @foreach($output['lstNotifications'] as $row)
                    <div class="col-md-4">{{$row['name']}}</div>
                   @endforeach
                </div>
            </div>
        </div>
        
        {!!Helper::display(array("colspan"=>12,"label"=>"Incident Severity","name"=>"incident_sev","value"=>$results['incident_sev']))!!}
        <fieldset>
            <legend>QA Comments</legend>
            <div class="row">
                {!!Helper::display(array("colspan"=>3,"label"=>"Probability","value"=>$results['probability'])) !!}
                {!!Helper::display(array("colspan"=>3,"label"=>"Severity","value"=>$results['severity'])) !!}
                {!!Helper::display(array("colspan"=>3,"label"=>"Grade","value"=>$results['grade'])) !!}
                {!!Helper::display(array("colspan"=>3,"label"=>"Category","name"=>"category","value"=>$results['categoryName'])) !!}
            </div>
            
            {!!Helper::display(array("colspan"=>12,"label"=>"Expected Outcome","value"=>$results['expectedOutcome'])) !!}
            {!!Helper::display(array("colspan"=>12,"label"=>"Comments","value"=>$results['qa_comments'])) !!}
             {!!Helper::display(array("colspan"=>12,"label"=>"Final Comments","value"=>$results['final_comments'])) !!}
        </fieldset>
        <div class="accordion" id="accView">
            {!! Helper::accordion(array("id"=>"c6","parent"=>"accView","label"=>"Assignments"))!!}
           {!! Helper::responsiveTable(array("Assigned To","Date","Assigned By","Exp. Closing Date","Closed Date","Status"))!!}
            
            <?php
                foreach($lstLogs as $row):
                ?>
                <tr>
                  <td><a href="Javascript:void(0)" data-id="{{$row['id']}}" class="lnkTrackView">{!! $row['assigned_to_name'] !!}</a></td>
                  <td data-sort="{{ strtotime($row['created_at'])}}">{{  $row['fAssignDate'] }}</td>
                  <td>{!! $row['assigned_by_name'] !!}</td>
                  <td data-sort="{{ strtotime($row['exp_closing_date'])}}">{{  $row['fExpCloseDate'] }}</td>
                  <?php
                    if($row['status'] == 10){
                        ?> <td data-sort="{{ strtotime($row['closed_date'])}}">{{ $row['fClosedDate'] }}</td><?php
                    }
                    else{
                        echo "<td></td>";
                    }
                  ?>
                  <td>{!! $row['statusname'] !!}</td>
                </tr>
                <?php
                  endforeach;
                ?>
            {!! Helper::closeResponsiveTable() !!}
            {!! Helper::closeAccordion() !!}
            {!! Helper::accordion(array("id"=>"c0","parent"=>"accView","label"=>"Events"))!!}
            @include('admin/incidents/viewEvents')
            {!! Helper::closeAccordion() !!}
            {!! Helper::accordion(array("id"=>"c1","parent"=>"accView","label"=>"Details"))!!}
            @foreach($output['lstDetails'] as $row)
                <h6>{{$row['name']}}</h6><br>
                <p>{!! $row['details'] !!}</p>
            @endforeach
             {!! Helper::closeAccordion() !!}
            
            {!! Helper::accordion(array("id"=>"c5","parent"=>"accView","label"=>"Attachments"))!!}
            {!! Helper::gallery(array("module"=>"INCIDENTS","id"=>$id,"mode"=>"VIEW"))!!}

            {!! Helper::closeAccordion() !!}
        </div>
    </div>
 {{--    <div class="col-lg-4 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Assignments</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    
                </div>
            </div>
        </div>
    </div> --}}
</div>
<div class="modal fade text-left" id="mTask" tabindex="-1" role="dialog" aria-labelledby="myAddBUlabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            {!!Helper::form(array("name"=>"frm","action"=>"admin/incidents/add-comments","validate"=>"Yes"))!!}
            {!!Helper::hidden(array("name"=>"id","value"=>$id))!!}
            {!!Helper::hidden(array("name"=>"taskid","value"=>""))!!}
            <div class="modal-header">
                <h4 class="modal-title" id="myAddBUlabel">Task Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="modalTaskContents"></div>
<!--
                {!! Helper::textbox(array("colspan"=>12,"label"=>"Comments","name"=>"comments","placeholder"=>"Enter Notes","typ"=>"textarea","class"=>" validate[required]","required"=>"Yes","value"=>""))!!}
-->
            </div>
            <div class="modal-footer">
               {{--  <button type="submit" class="btn btn-primary">Update Comments</button> --}}
            </div>
            {!!Helper::close("form")!!}
        </div>
    </div>
</div>
