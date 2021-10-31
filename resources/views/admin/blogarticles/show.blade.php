@extends('layouts/contentLayoutMaster')
@section('title', 'Blog Articles Detail')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}

  <img src="{{ asset('public/blogarticles/'.$blogArticles->image) }}" style="width: 250px; height: 120px; margin-bottom: 20px;">

  <div class="row">
    {!! Helper::display(array("colspan"=>4,"label"=>"Title","name"=>"title","value"=>$blogArticles['title'])) !!}
    {!! Helper::display(array("colspan"=>4,"label"=>"Postdate","name"=>"postdate","value"=>$blogArticles['postdate'])) !!}
    {!! Helper::display(array("colspan"=>4,"label"=>"Summary","name"=>"summary","value"=>$blogArticles['summary'])) !!}
    {!! Helper::display(array("colspan"=>4,"label"=>"Author","name"=>"author","value"=>$blogArticles['author'])) !!}
  </div>
  {!! Helper::display(array("colspan"=>12,"name"=>"body","value"=>$blogArticles['body'],"label"=>"Body"))!!}
  {!! Helper::closePage() !!}
@endsection

