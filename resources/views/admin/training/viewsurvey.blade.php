<?php
    use App\Helpers\ApolloHelpers;
?>
@extends('layouts/contentLayoutMaster')
@section('title', 'Training')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
    {!! Helper::form(array("name"=>"frm","action"=>"admin/training/edit","validate"=>"Yes"))!!}
    {!! Helper::hidden(array("name"=>"action","value"=>"edit")) !!}
    {!! Helper::hidden(array("name"=>"id","value"=>$id))!!}
    <div class="row">

    </div>
    <?php
        $startdate=date('d/m/Y',strtotime($results['start_date']));
        $last_attend=date('d/m/Y',strtotime($results['last_attend']));
    ?>
    <div class="row">
    {!! Helper::display(array("name"=>"user_id","colspan"=>3,"label"=>"User Name","value"=>$results['username']))!!}
    {!! Helper::display(array("colspan"=>4,"label"=>"Training Name","name"=>"trainind_id","value"=>$results['name']))!!}
  </div>

  <div class="row">
        {!! Helper::display(array("colspan"=>4,"label"=>"Training Start Date","name"=>"start_date","typ"=>"date","value"=>$startdate))!!}
        {!! Helper::display(array("colspan"=>4,"label"=>"Training complete Date","name"=>"complete_date","typ"=>"date","value"=>$results['fCompletedDate']))!!}
        {!! Helper::display(array("colspan"=>4,"label"=>"Last Attended Date","name"=>"last_attend","typ"=>"date","value"=>$last_attend))!!}
        {!! Helper::display(array("colspan"=>4,"label"=>"Status","name"=>"status","value"=>$results['statusname'])) !!}
  </div>
    <br/>
    <legend>{{$results['surveyName']}}</legend>
    <div class="row">
        {!! Helper::display(array("colspan"=>4,"label"=>"Max. Points","value"=>$results['maxPoints']))!!}
        {!! Helper::display(array("colspan"=>4,"label"=>"Secured Points","value"=>$results['secured_points']))!!}
    </div>
    <table class="table table-striped">
        <tr><th>Question</th><th>Answer</th><th>Points</th></tr>
        @foreach($lstAnswers as $r)
            <tr>
                <td>{{$r['question']}}</td>
                <td>{{$r['answer']}}</td>
                <td>{{$r['points']}}</td>
            </tr>
        @endforeach
    </table>
    {!! Helper::close("form")!!}
    {!! Helper::closePage() !!}
@endsection

