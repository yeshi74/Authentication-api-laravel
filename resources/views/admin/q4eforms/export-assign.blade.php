<center><h4>{{$results->name}}</h4></center>
<p><strong>Validated on {{date('d/m/Y H:i',strtotime($lstAssignDetails['assignDetails']['validated_on']))}}  by {{$lstAssignDetails['assignDetails']['validated_user_name']}}</strong></p>
<table width="100%">
    <tr>
        <td>Type</td><td>Assigned To</td><td>Assigned On</td><td>Completed On</td>
    </tr>
    <tr>
        <td>{{$lstAssignDetails['formDetails']['typname']}}</td>
        <td>{{$lstAssignDetails['assignDetails']['username']}}</td>
        <td>{{date('d/m/Y',strtotime($lstAssignDetails['assignDetails']['assign_date']))}}</td>
        <td>{{date('d/m/Y H:i',strtotime($lstAssignDetails['assignDetails']['completed_date']))}}</td>
    </tr>
</table>
<?php
    $ctr=1;
    foreach($lstAssignDetails['lstSections']  as $row)
    {
        $section = $row['section'];
        ?>
        <h4>{!! $section['name'] !!}</h4>
        <table width="100%">
            <thead>
                <tr>
                    <th>Sr#</th>
                    <th>Label</th>
                    <th>Value</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                @foreach($row['lstItems'] as $i)
                    <tr>
                        <td>{{$i['ctr']}}</td>
                        <td>{{$i['name']}}</td>
                        <td>{{$i['answer']}}</td>
                        <td>{{$i['remarks']}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <?php 
          $ctr++;
    }
?>