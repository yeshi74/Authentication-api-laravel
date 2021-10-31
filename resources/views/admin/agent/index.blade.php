@extends('layouts/contentLayoutMaster')
@section('title', 'Agents')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
  {{-- {!! Helper::form(array("name"=>"frm","action"=>"admin/faq/view")) !!} --}}
  {!! Helper::hidden(array("name"=>"action","value"=>"view"))!!}
  {!! Helper::hidden(array("name"=>"id","value"=>""))!!}
  <a class="btn btn-primary" href="{{ route('agent.add') }}" role="button">Add</a>

  
  {!! Helper::responsiveTableEx(array("Name","Email", "City", "State", "Pincodes"))!!}
  <?php
    foreach($agents as $row):
      ?>
      <tr>
        <td>
          <a href="{{ route('agent.view', $row->id) }}">{{ $row->name }}</a>
          </td>
          <td>
            {{ $row->email }}
        </td>
        <td>
            {{ $row->city }}
        </td>
        <td>
            {{ $row->state }}
        </td>
        <td>
            {{ json_encode($row->pincodes, TRUE) }}
        </td>
        <td>
            <a class="btn" onclick="return confirm('Are you sure, you want to delete?')" role="button">
                <form action="{{ route('agent.delete', $row->id) }}" method="post">
                    <input class="btn btn-danger" style="padding:6px;" type="submit" value="Delete" />
                        {!! method_field('delete') !!}
                        {!! csrf_field() !!}
                </form>
                </a>        
            </td>
      </tr>
      <?php
        endforeach;
      ?>
  {!! Helper::closeResponsiveTable()!!}
  {!! Helper::close("form")!!}
  {!! Helper::closePage() !!} 
@endsection


