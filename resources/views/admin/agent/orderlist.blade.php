@extends('layouts/contentLayoutMaster')
@section('title', 'Agent Orders')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
  {{-- {!! Helper::form(array("name"=>"frm","action"=>"admin/faq/view")) !!} --}}
  {!! Helper::hidden(array("name"=>"action","value"=>"view"))!!}
  {!! Helper::hidden(array("name"=>"id","value"=>""))!!}
  {{-- <a class="btn btn-primary" href="{{ route('contents.add') }}" role="button">Add</a> --}}

  
  {!! Helper::responsiveTableEx(array("Customer name", "Order date", "Pincode", "City"))!!}
  <?php
    foreach($agentOrder as $row):
      ?>
      <tr>
        <td>
          <a href="{{ route('agent.vieworder', $row->id) }}">{{ $row->customer_name }}</a>
          </td>
          <td>
            {{ $row->order_date }}
        </td>
        <td>
            {{ $row->pincode }}
        </td>
        <td>
            {{ $row->city }}
        </td>
        {{-- <td>
            <a class="btn" onclick="return confirm('Are you sure, you want to delete?')" role="button">
                <form action="#" method="post">
                    <input class="btn btn-danger" style="padding:6px;" type="submit" value="Delete" />
                        {!! method_field('delete') !!}
                        {!! csrf_field() !!}
                </form>
                </a>        
            </td> --}}
      </tr>
      <?php
        endforeach;
      ?>
  {!! Helper::closeResponsiveTable()!!}
  {!! Helper::close("form")!!}
  {!! Helper::closePage() !!} 
@endsection


