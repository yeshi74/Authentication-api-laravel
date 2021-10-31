@extends('layouts/contentLayoutMaster')
@section('title', 'Close Periods')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
    <div class="row">
        {!! Helper::display(array("colspan"=>3,"label"=>"Type","value"=>$data['typname']))!!}
        {!! Helper::display(array("colspan"=>3,"label"=>"Form","value"=>$data['formname']))!!}
        {!! Helper::display(array("colspan"=>3,"label"=>"Period","value"=>$data['periodname']))!!}
        {!! Helper::display(array("colspan"=>3,"label"=>"Status","value"=>$data['perstatusname']))!!}
    </div>
   
    {!! Helper::responsiveTable(array("id","User","Location","Assigned On","Start Date","End Date","Completed On","Last Updated","Status",""))!!}
    @foreach($results as $row)
        <tr>
            <td>{{$row['id']}}</td>
            <td>
                @if($row['isassign']==1)
                    <a href="{{url('admin/q4ereports/usage/view/'.$row['id'])}}">{{$row['username']}}</a>
                @else 
                    {{$row['username']}}
                @endif 
            </td>
            <td>{{$row['locname']}}</td>
            <td>{{$row['assign_date']}}</td>
            <td>{{$row['start_date']}}</td>
            <td>{{$row['end_date']}}</td>
            <td>{{$row['completed_date']}}</td>
            <td>{{$row['last_update']}}</td>
            <td>{{$row['statusName']}}
                @if($row['forced_closed'] == 1 && $row['status'] == 20)
                    <span style="color:red"><i class="fa fa-circle"></i></span>&nbsp;<small><strong>Closed Forcibly</strong></small>
                @endif
            </td>
            <td>
                @if($row['status']==20)
                    <button class="btn btn-warning btnOpen" data-id="{{$row['id']}}">Reopen</button>
                @else
                <button class="btn btn-warning btnClose" data-id="{{$row['id']}}">Close</button>
                @endif
            </td>
        </tr>
    @endforeach
    {!! Helper::closeResponsiveTable()!!}
    {!! Helper::closePage() !!}
    {!!Helper::form(array("name"=>"frmReopen","action"=>"admin/q4eforms/close-periods/reopen","validate"=>"Yes"))!!}
    {!!Helper::hidden(array("name"=>"formid","value"=>$data['formid']))!!}
    {!!Helper::hidden(array("name"=>"typ","value"=>$data['typ']))!!}
    {!!Helper::hidden(array("name"=>"period","value"=>$data['period']))!!}
    {!!Helper::hidden(array("name"=>"perid","value"=>$data['perid']))!!}
    {!!Helper::hidden(array("name"=>"r","value"=>""))!!}
    {!! Helper::close("form")!!}
    
    {!!Helper::form(array("name"=>"frmClose","action"=>"admin/q4eforms/close-periods/close","validate"=>"Yes"))!!}
    {!!Helper::hidden(array("name"=>"formid","value"=>$data['formid']))!!}
    {!!Helper::hidden(array("name"=>"typ","value"=>$data['typ']))!!}
    {!!Helper::hidden(array("name"=>"period","value"=>$data['period']))!!}
    {!!Helper::hidden(array("name"=>"perid","value"=>$data['perid']))!!}
    {!!Helper::hidden(array("name"=>"c","value"=>""))!!}
    {!! Helper::close("form")!!}

@endsection
@section('myscript')
<script>
   $(".btnOpen").on('click',function(){
       var id = $(this).data("id");
       if(confirm("Are you sure you want to open this form?")) {
           $("#r").val(id);
           $("#frmReopen").submit();
       }
   });
   $(".btnClose").on('click',function(){
       var id = $(this).data("id");
       if(confirm("Are you sure you want to close this form?")) {
           $("#c").val(id);
           $("#frmClose").submit();
       }
   })
</script>
@endsection
