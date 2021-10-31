@extends('layouts/contentLayoutMaster')
@section('title', 'Q4E Forms')
@section('content')
    {!!Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
    {!!Helper::linkButton(array("url"=>url('admin/q4eforms/'.$ftype.'/calc/'.$id),"name"=>"btnAdd","label"=>"Calc Results","class"=>"btn-primary btnAdd"))!!}

    <section id="column-selectors">
        <h4>{{$results->name}}</h4>
        @if($lstAssignDetails['assignDetails']['is_valid']==0)
            {!!Helper::form(array("name"=>"frm","action"=>"admin/q4eforms/".$ftype."/assign/validate","validate"=>"Yes"))!!}
            {!!Helper::hidden(array("name"=>"id","value"=>$id))!!}
            {!!Helper::hidden(array("name"=>"ftype","value"=>$ftype))!!}
            {!!Helper::button(array("colspan"=>12,"name"=>"btnSave","label"=>"Validate","type"=>"submit"))!!}
            {!!Helper::close("form")!!}
        @else
            {!!Helper::button(array("colspan"=>12,"name"=>"btnExport","label"=>"Export Results","type"=>"button"))!!}
            <strong><i class="fa fa-exclamation"></i>&nbsp;Validated on {{date('d/m/Y H:i',strtotime($lstAssignDetails['assignDetails']['validated_on']))}}  by {{$lstAssignDetails['assignDetails']['validated_user_name']}}</strong>
            <hr/>
        @endif
        
        <div class="row">
            {!! Helper::display(array("colspan"=>3,"label"=>"Type","value"=>$lstAssignDetails['formDetails']['typname']))!!}
            {!! Helper::display(array("colspan"=>3,"label"=>"Assigned To","value"=>$lstAssignDetails['assignDetails']['username']))!!}
            {!! Helper::display(array("colspan"=>3,"label"=>"Assigned On","value"=>date('d/m/Y',strtotime($lstAssignDetails['assignDetails']['assign_date']))))!!}
            {!! Helper::display(array("colspan"=>3,"label"=>"Completed On","value"=>date('d/m/Y H:i',strtotime($lstAssignDetails['assignDetails']['completed_date']))))!!}
        </div>
        <div class="accordion" id="accView">
        <?php

            $ctr=1;
        ?>
            @foreach($lstAssignDetails['lstSections']  as $row)
                <?php 
                    $section = $row['section'];
                ?>
                {!! Helper::accordion(array("id"=>"c".$ctr,"parent"=>"accView","label"=>$section['name'])) !!}
                {!! Helper::responsiveTable(array("Sr#","Label","Value","Remarks",""))!!}
                @foreach($row['lstItems'] as $i)
                    <tr>
                        <td>{{$i['ctr']}}</td>
                        <td><a href="Javascript:void(0)" class="lnkAssignView" data-id="{{$i['answerID']}}" data-name="{{$i['name']}}" data-answer="{{$i['answer']}}" data-remarks="{{$i['remarks']}}">{{$i['name']}}</a></td>
                        <td>{{$i['answer']}}</td>
                        <td>{{$i['remarks']}}</td>
                        <td><a href="Javascript:void(0)" class="lnkAssignEdit" data-id="{{$i['answerID']}}" data-name="{{$i['name']}}" data-answer="{{$i['answer']}}" data-remarks="{{$i['remarks']}}"><i class="fa fa-pencil"></i></a></td>
                    </tr>
                @endforeach
                {!! Helper::closeResponsiveTable()!!}
                {!! Helper::closeAccordion() !!}
                <?php 
                $ctr++;
                ?> 
            @endforeach
        
        </div>
        {!! Helper::display(array("colspan"=>12,"label"=>"Remarks","value"=>$lstAssignDetails['assignDetails']['remarks']))!!}
        {!! Helper::gallery(array("module"=>"Q4E","id"=>$id,"mode"=>"VIEW"))!!}
    </section>
    {!! Helper::closePage()!!}
    {!!Helper::form(array("name"=>"frmExport","action"=>"admin/q4eforms/".$ftype."/assign/export","target"=>"_new"))!!}
    {!!Helper::hidden(array("name"=>"id","value"=>$id))!!}
    {!!Helper::hidden(array("name"=>"ftype","value"=>$ftype))!!}
    {!!Helper::close("form")!!}
    <div class="modal fade text-left" id="modalVI" tabindex="-1" role="dialog" aria-labelledby="myAddBUlabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myAddBUlabel">View Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Question</label><br><span id="vQuestion"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Answer</label><br><span id="vAnswer"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Remarks</label><br><span id="vRemarks"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade text-left" id="modalVE" tabindex="-1" role="dialog" aria-labelledby="myAddBUlabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myAddBUlabel">Edit Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Helper::form(array("name"=>"frmAssignEdit","action"=>"admin/q4eforms/".$ftype."/assign/update-results"))!!}
                {!! Helper::hidden(array("name"=>"id","value"=>$id))!!}
                {!! Helper::hidden(array("name"=>"tid","value"=>""))!!}
                {!!Helper::hidden(array("name"=>"ftype","value"=>$ftype))!!}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Question</label><br><span id="eQuestion"></span>
                        </div>
                    </div>
                    {!! Helper::textbox(array("colspan"=>12,"name"=>"eanswer","label"=>"Answer"))!!}
                    {!! Helper::textbox(array("colspan"=>12,"name"=>"eremarks","label"=>"Remarks"))!!}
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                {!! Helper::close("form") !!}
            </div>
        </div>
    </div>
@endsection
@section('myscript')
    <script>
        $("#btnExport").on('click',function(){
            $("#frmExport").submit();
        });
        $(".lnkAssignView").on('click',function(){
            var _answer = $(this).data("answer");
            var _question = $(this).data("name");
            var _remarks = $(this).data("remarks");
            $("#vQuestion").html(_question);
            $("#vAnswer").html(_answer);
            $("#vRemarks").html(_remarks);
            $("#modalVI").modal('show');
        });
        $(".lnkAssignEdit").on('click',function(){
            var _answer = $(this).data("answer");
            var _question = $(this).data("name");
            var _remarks = $(this).data("remarks");
            var _id = $(this).data("id");
            $("#eQuestion").html(_question);
            $("#eanswer").val(_answer);
            $("#eremarks").val(_remarks);
            $("#tid").val(_id);
            $("#modalVE").modal('show');
        });
    </script>
@endsection