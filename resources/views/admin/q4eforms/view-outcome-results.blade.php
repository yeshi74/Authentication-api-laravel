<?php
    use App\Helpers\ApolloHelpers;
    $ctr=1;
?>
@extends('layouts/contentLayoutMaster')
@section('title', 'Q4E Forms')
@section('content')
	{!!Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
    <div class="row">
        <div class="col-md-12">
            {!! Helper::linkButton(array("url"=>url('admin/q4eforms/'.$ftype.'/outcome/editresults/'.$id),"label"=>"Edit","class"=>"btn btn-primary"))!!}
             {!! Helper::linkButton(array("url"=>url('admin/q4eforms/'.$ftype.'/outcome/detailresults/'.$id),"label"=>"Detailed Results","class"=>"btn btn-primary"))!!}
           
        </div>
    </div>
    <div class="row">
        {!!Helper::display(array("colspan"=>3,"label"=>"User","value"=>$results['username']))!!}
        {!!Helper::display(array("colspan"=>3,"label"=>"Location","value"=>$results['locname']))!!}
        {!!Helper::display(array("colspan"=>3,"label"=>"Status","value"=>$results['statusName']))!!}
        {!!Helper::display(array("colspan"=>3,"label"=>"Score","value"=>$results['total_score']))!!}
    </div>
    <div class="row">
        {!!Helper::display(array("colspan"=>3,"label"=>"Assigned Date","value"=>date('d/m/Y',strtotime($results['assign_date']))))!!}
        {!!Helper::display(array("colspan"=>3,"label"=>"Completed Date","value"=>$results['completeDate']))!!}
    </div>
    <div class="table responsive" style="width:100%;overflow:auto;">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Sr #</th>
                    <th>Parameter</th>
                    <th>Numerator</th>
                    <th>Value</th>
                    <th>Denominator</th>
                    <th>Value</th>
                    <th>UOM</th>
                    <th>Score</th>
                    <th>Score Range</th>
                    <th>Reason</th>
                    <th>Action Plan</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
            @foreach($lstAnswers['inputItems'] as $row)
                <tr>
                    <td>{{$row['index']}}</td>
                    <td>{{$row['parameter']}}</td>
                    <td>{{$row['numerator']}}</td>
                    <td>{{$row['nval']}}</td>
                    <td>{{$row['denominator']}}</td>
                    <td>{{$row['dval']}}</td>
                    <td>{{$row['uomName']}} {{$row['formula']}}</td>
                    <td style="background:{{$row['score_color']}};color:#fff">{{$row['score_val']}}</td>
                    <td style="background:{{$row['score_color']}};color:#fff">{{$row['score']}}</td>
                    <td>{!!$row['reason']!!}</td>
                    <td>{!!$row['action_plan']!!}</td>
                    <td>{!!$row['qa_remarks']!!}</td>
                </tr>
            @endforeach
            @foreach($lstAnswers['qaItems'] as $row)
                @if($row['show']==1)
                    <tr>
                        <td>{{$row['index']}}</td>
                        <td>{{$row['parameter']}}</td>
                        <td>{{$row['numerator']}}</td>
                        <td>{{$row['nval']}}</td>
                        <td>{{$row['denominator']}}</td>
                        <td>{{$row['dval']}}</td>
                        <td style="background:{{$row['score_color']}};">{{$row['score_val']}}</td>
                        <td style="background:{{$row['score_color']}};">{{$row['score']}}</td>
                         <td>{!!$row['reason']!!}</td>
                    <td>{!!$row['action_plan']!!}</td>
                    <td>{!!$row['qa_remarks']!!}</td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
    {!! Helper::closePage()!!}
@endsection
@section('myscript')
<script>
   
</script>
@endsection