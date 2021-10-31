@extends('layouts/contentLayoutMaster')
@section('title', 'Contents Detail')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
  <div class="row">
    <a class="btn btn-primary" href="{{ route('contents.edit', $contents->id) }}" role="button">Edit</a>
  </div><br><br>

  <img src="{{ asset('public/contents/'.$contents->coverimg) }}" style="width: 250px; height: 120px; margin-bottom: 20px;">

  <div class="row">
    {!! Helper::display(array("colspan"=>4,"label"=>"Type","name"=>"typ","value"=>$contents['typ'])) !!}
    {!! Helper::display(array("colspan"=>4,"label"=>"Subject","name"=>"subject","value"=>$contents['subject'])) !!}
    {!! Helper::display(array("colspan"=>4,"label"=>"Body","name"=>"body","value"=>$contents['body'])) !!}
    {!! Helper::display(array("colspan"=>4,"label"=>"Status","name"=>"status","value"=>$contents['status'])) !!}
  </div>
  {{-- {!! Helper::display(array("colspan"=>12,"name"=>"body","value"=>$contents['body'],"label"=>"Body"))!!} --}}
  {!! Helper::closePage() !!}
@endsection

