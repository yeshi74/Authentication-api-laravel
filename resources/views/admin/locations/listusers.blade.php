@extends('layouts/contentLayoutMaster')
@section('title', 'Locations')
@section('content')
{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
{!! Helper::responsiveTable(array("User","Emp. Code","E-Mail","Joined Date","Last Logged","Status"))!!}
@foreach($results as $row)
    <?php 
        $status = $row->status == 0 ? "Active" : "Suspended"; 
        $lastLogged="";
        if($row->last_logged != "") $lastLogged = date('d/m/Y H:i',strtotime($row->last_logged));
    ?>
    <tr>
        <td><a href="{{url('admin/adminusers/view/'.$row->id)}}">{{$row->name}}</a></td>
        <td>{{$row->emp_code}}</td>
        <td>{{$row->email}}</td>
        <td>{{date('d/m/Y H:i',strtotime($row->created_at))}}</td>
        <td>{{$lastLogged}}</td>
        <td>{{$status}}</td>
    </tr>
@endforeach
{!! Helper::closeResponsiveTable()!!}
{!!Helper::close("form")!!}
{!! Helper::closePage()!!}
</section>
@endsection


