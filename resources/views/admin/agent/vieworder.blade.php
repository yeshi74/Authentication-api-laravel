@extends('layouts/contentLayoutMaster')
@section('title', 'Agent Order Detail')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
  {{-- <div class="row">
    <a class="btn btn-primary" href="{{ route('contents.edit', $contents->id) }}" role="button">Edit</a>
  </div><br><br> --}}

  {{-- <img src="{{ asset('public/contents/'.$contents->coverimg) }}" style="width: 250px; height: 120px; margin-bottom: 20px;"> --}}

  <div class="row">
    {!! Helper::display(array("colspan"=>4,"label"=>"Customer name","name"=>"customer_name","value"=>$agentOrder['customer_name'])) !!}
    {!! Helper::display(array("colspan"=>4,"label"=>"Order date","name"=>"order_date","value"=>$agentOrder['order_date'])) !!}
    {!! Helper::display(array("colspan"=>4,"label"=>"Address","name"=>"address","value"=>$agentOrder['address'])) !!}
    {!! Helper::display(array("colspan"=>4,"label"=>"Collection notes","name"=>"collection_notes","value"=>$agentOrder['collection_notes'])) !!}
    {!! Helper::display(array("colspan"=>4,"label"=>"Pincode","name"=>"pincode","value"=>$agentOrder['pincode'])) !!}
    {!! Helper::display(array("colspan"=>4,"label"=>"City","name"=>"city","value"=>$agentOrder['city'])) !!}
    {!! Helper::display(array("colspan"=>4,"label"=>"Location","name"=>"location","value"=>$agentOrder['location'])) !!}
    {!! Helper::display(array("colspan"=>4,"label"=>"Notes","name"=>"notes","value"=>$agentOrder['notes'])) !!}
  </div>
  {{-- {!! Helper::display(array("colspan"=>12,"name"=>"body","value"=>$contents['body'],"label"=>"Body"))!!} --}}
  {!! Helper::closePage() !!}
@endsection

