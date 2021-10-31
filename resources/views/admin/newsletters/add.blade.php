<?php
    use App\Helpers\ApolloHelpers;
?>
@extends('layouts/contentLayoutMaster')
@section('title', 'Communications')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>"")) !!}
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div><br />
    @endif
    {!! Helper::form(array("name"=>"frm","action"=>"admin/newsletters/save","validate"=>"Yes")) !!}
    {!! Helper::hidden(array("name"=>"action","value"=>"save")) !!}
    {!! Helper::button(array("colspan"=>12,"name"=>"btnSave","label"=>"Save","type"=>"submit")) !!}
    {!! Helper::textbox(array("colspan"=>12,"label"=>"Subject","name"=>"subject","max"=>150,"placeholder"=>"Enter subject","required"=>"Yes","class"=>"validate[required]","value"=>old('subject'))) !!}
    
    <div class="row">
        {!! Helper::textbox(array("colspan"=>3,"label"=>"Period","name"=>"period","placeholder"=>"Enter Period","class"=>"validate[required]","required"=>"Yes","value"=>old('period'),"typ"=>"date")) !!}
        {!! Helper::selectStatus(array("colspan"=>3,"label"=>"Status","name"=>"status","value"=>old('status')))!!}
        {!! Helper::select(array("colspan"=>3,"options"=>array("0"=>"No","1"=>"Yes"),"label"=>"Is Public","name"=>"is_public","value"=>old('is_public'))) !!}

      </div>
    <div class="row">
        {!! Helper::select(array("colspan"=>3,"label"=>"Type","name"=>"typ","options"=>array("PDF"=>"PDF","VIDEO"=>"VIDEO"),"value"=>old('status')))!!}
        <div class="col-md-9">
            <div id="divFile">
                {!! Helper::textbox(array("colspan"=>12,"label"=>"NewsLetter Attachment","name"=>"file","typ"=>"FILE")) !!}  
            </div>
            <div id="divVideo" style="display:none;">
                {!! Helper::textbox(array("colspan"=>12,"label"=>"Video Link (https://youtube.com/embed/","name"=>"video")) !!}  
            </div>
        </div>
    </div>
    
    {!! Helper::textbox(array("colspan"=>12,"label"=>"Summary","name"=>"summary","placeholder"=>"Enter Summary","required"=>"Yes","class"=>"validate[required]","typ"=>"HTML","value"=>old('summary'))) !!}
    <?php echo ApolloHelpers::locationTree(array("name"=>"locations","mode"=>"ADD","selLocations"=>array())); ?>
    {!! Helper::close("form")!!}
    {!! Helper::closePage()!!}
@endsection

@section('myscript')
<script>
   
    $("#typ").on('change',function(){
        var t = $(this).val();
        if(t=="VIDEO"){
            $("#divFile").hide();
            $("#divVideo").show();
        }
        else
        {
            $("#divFile").show();
            $("#divVideo").hide();
        }
    });
</script>
@endsection
