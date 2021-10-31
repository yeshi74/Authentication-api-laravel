@extends('layouts/contentLayoutMaster')
@section('title', 'Vaccination')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
  {!! Helper::form(array("name"=>"frm","action"=>"admin/faq/view")) !!}
  {!! Helper::hidden(array("name"=>"action","value"=>"view"))!!}
  {!! Helper::hidden(array("name"=>"id","value"=>""))!!}
  <a class="btn btn-primary" href="{{ route('vaccination.create')}}" role="button">Add</a>
  <!-- <a class="btn btn-success" href="{{ route('vaccinationDosage.index') }}" role="button">Dosage</a> -->

  
  {!! Helper::responsiveTableEx(array("Name","Details","Consent Form","Consent Details","Price","Discounted Price","Dosages","Home Collection","Code","Action"))!!}
  <?php
    foreach($vaccinations as $row):
      if($b['status'] = $row->status == 0){
      $_id = $row['id'];
      $status = "";
      if($row['status'] == 0) $status= "New";
      if($row['status'] == 10) $status= "Replied";
      if($row['status']==20) $status = "Closed";
      $message=str_limit(strip_tags($row['message']),200);
      $url = "<a href='".url('admin/feedback/view/'.$row['id'])."'>".$message."</a>";
      ?>
      <tr>
        <td>
          <a href="{{ route('vaccination.view', $row->id)}}">{{ $row->name }}</a>
        </td>
        <td>{{ $row->details }}</td>
        <td>{{ $row->consent_form }}</td>
        <td>{{ $row->consent_details }}</td>
        <td>{{ $row->price }}</td>
        <td>{{ $row->discounted_price }}</td>
        <td>{{ $row->dosages }}</td>
        <td>{{ $row->home_collection }}</td>
        <!-- <td>{!! $status !!}</td> -->
        <!-- <td>{{ $row->img }}</td> -->
        <td>{{ $row->code }}</td>
        <td>
            <a class="btn btn-info btn-sm" href="{{ route('vaccination.view', $row->id)}}" role="button">View</a>
        </td>
      </tr>
      <?php
      }
        endforeach;
      ?>
  {!! Helper::closeResponsiveTable()!!}
  {!! Helper::close("form")!!}
  {!! Helper::closePage() !!} 
@endsection


