@extends('layouts/contentLayoutMaster')
@section('title', 'Q4E Forms')
@section('content')
	{!!Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
    {!!Helper::form(array("name"=>"frm","action"=>"admin/q4eforms/".$ftype."/outcome/updateresults","validate"=>"Yes"))!!}
    {!!Helper::hidden(array("name"=>"id","value"=>$id))!!}
    {!!Helper::hidden(array("name"=>"ftype","value"=>$ftype))!!}
    <div class="row">
        <div class="col-md-12">
            {!! Helper::button(array("name"=>"btnSubmit","type"=>"submit","label"=>"Update Results")) !!}
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
                    <td><input type="textbox" name="n{{$row['id']}}" class="form-control validate[required,custom[number]]" id="n{{$row['id']}}" value="{{$row['nval']}}"/></td>
                    <td>{{$row['denominator']}}</td>
                    <td><input type="textbox" name="d{{$row['id']}}" class="form-control validate[required,custom[number]]" id="d{{$row['id']}}" value="{{$row['dval']}}"/></td>
                    <td>{!!$row['reason']!!}</td>
                    <td>{!!$row['action_plan']!!}</td>
                    <td><input type="textbox" class="form-control" name="r{{$row['id']}}" id="r{{$row['id']}}" value="{!!$row['qa_remarks']!!}"/></td>
                </tr>
            @endforeach
            @foreach($lstAnswers['qaItems'] as $row)
                @if($row['show']==1)
                    <tr>
                        <td>{{$row['index']}}</td>
                        <td>{{$row['parameter']}}</td>
                        <td>{{$row['numerator']}}</td>
                         <td><input type="textbox" name="n{{$row['id']}}" class="form-control validate[required,custom[number]]" id="n{{$row['id']}}" value="{{$row['nval']}}"/></td>
                        <td>{{$row['denominator']}}</td>
                        <td><input type="textbox" name="d{{$row['id']}}" class="form-control validate[required,custom[number]]" id="d{{$row['id']}}" value="{{$row['dval']}}"/></td>
                         <td>{!!$row['reason']!!}</td>
                         <td>{!!$row['action_plan']!!}</td>
                        <td><input type="textbox" class="form-control" name="r{{$row['id']}}" id="r{{$row['id']}}" value="{!!$row['qa_remarks']!!}"/></td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
    {!! Helper::close("form")!!}
    {!! Helper::closePage()!!}
@endsection
@section('myscript')
<script>
   
</script>
@endsection