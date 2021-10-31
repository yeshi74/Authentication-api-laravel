<?php
    use App\Helpers\ApolloHelpers;
?>
@extends('layouts/contentLayoutMaster')
@section('mystyle')
@endsection
@section('title', 'Q4E Forms')
@section('content')
    {!!Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
    {!!Helper::form(array("name"=>"frm","action"=>"admin/q4eforms/".$ftype."/save","validate"=>"Yes"))!!}
    {!!Helper::hidden(array("name"=>"ftype","value"=>$ftype))!!}
    {!!Helper::button(array("colspan"=>12,"name"=>"btnSave","label"=>"Save & Next","type"=>"submit"))!!}
    <section id="column-selectors">
        {!! Helper::textbox(array("name"=>"name","placeholder"=>"Enter Name","colspan"=>12,"label"=>"Name","class"=>"validate[required]","max"=>50,"value"=>old('name'))) !!}
        <div class="row">
            {!! Helper::selectList(array("name"=>"typ","placeholder"=>"Enter Type","colspan"=>3,"label"=>"Type","required"=>"Yes","class"=>"validate[required]","options"=>$lstType,"key"=>"id","val"=>"name","value"=>old('typ'))) !!}
           {!! Helper::select(array("name"=>"frequency","placeholder"=>"Enter Frequency","colspan"=>2,"label"=>"Frequency","class"=>"","options"=>$lstFrequency,"value"=>old('frequency'))) !!}
            {!! Helper::textbox(array("name"=>"days_submit","placeholder"=>"Enter Days to Submit","colspan"=>2,"label"=>"Days to Submit","typ"=>"NUMBER","value"=>old('days_submit'))) !!}
            {!! Helper::selectList(array("name"=>"owner","placeholder"=>"Owner","colspan"=>3,"label"=>"Owner","required"=>"Yes","class"=>"validate[required]","options"=>$lstUsers,"key"=>"id","val"=>"name","value"=>old('owner'))) !!}
            {!!Helper::selectStatus(array("name"=>"status","placeholder"=>"Enter Status","colspan"=>2,"label"=>"Status","class"=>"textarea validate[required]","value"=>old('status')))!!}
            
        </div>
        <div class="row">
            <div class="col-md-2">
                <label>Select Color</label>
                <select id="color" name="color" class="select2 form-control colorChoice">
                    @foreach($lstColors as $c)
                        <?php for($ctr=0;$ctr<=14;$ctr++) { 
                            $v = $ctr==0 ? $c : $c."-".$ctr; 
                        ?>
                            <option value="{{$v}}">{{$c}} - {{$ctr}}</option>
                        <?php } ?>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1">
                <div style="width:100%;height:100%" id="divColor"></div>
            </div>
            <div class="col-md-2">
                <label>Select Icon</label>
                <select id="icon" name="icon" class="select2 form-control iconChoice">
                    @foreach($lstIcons as $c)
                        <option value="{{$c}}">{{$c}}</option>
                    @endforeach
                </select>
            </div>
             <div class="col-md-3">
                <div id="divIcon"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-12">
                <div class="form-group">
                    <label>Applicable to BU</label>
                    <select name="bu[]" id="bu" class="select2 form-control" multiple='multiple'>
                        @foreach($lstBU as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row" id="divMonths" style="display:none;">
            <div class="col-12 col-md-12">
                <div class="form-group">
                    <label>Run on Months</label>
                    <select name="months[]" id="months" class="select2 form-control" multiple='multiple'>
                        @foreach($lstMonths as $row)
                            <option value="{{$row['id']}}">{{$row['name']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        {!! Helper::textbox(array("name"=>"header","placeholder"=>"Enter Header","colspan"=>12,"label"=>"Header","class"=>"","value"=>old('header'))) !!}
        {!! Helper::textbox(array("name"=>"assign_msg","placeholder"=>"Message for Assignment","colspan"=>12,"label"=>"Message for Assignment","class"=>"validate[required]","value"=>old('assign_msg'))) !!}
        {!! Helper::textbox(array("name"=>"reminder_msg","placeholder"=>"Reminder Message","colspan"=>12,"label"=>"Reminder Message","class"=>"validate[required]","value"=>old('reminder_msg'))) !!}
        {!! Helper::textbox(array("name"=>"complete_msg","placeholder"=>"Complete Message","colspan"=>12,"label"=>"Complete Message","class"=>"validate[required]","value"=>old('complete_msg'))) !!}
        {!! Helper::textbox(array("name"=>"thankyou_msg","placeholder"=>"Thank You Message","colspan"=>12,"label"=>"Thank You Message","class"=>"validate[required]","value"=>old('thankyou_msg'))) !!}
        
        <?php echo ApolloHelpers::locationTree(array("name"=>"locations","mode"=>"ADD","selLocations"=>array())); ?>
        <fieldset>
            <legend>Properties</legend>
            <table class="table table-stripped">
            @foreach($lstProps as $row)
                <tr>
                    <td>{{$row->prop}}</td>
                    <td><input type="text" name="prop_{{$row->prop}}" id="prop_{{$row->prop}}" class="form-control"></td>
                </tr>
            @endforeach
            </table>
        </fieldset>
    </section>
    {!!Helper::close("form")!!}
    {!! Helper::closePage()!!}
@endsection
@section('myscript')
<script>
var path = "{{$imgPath}}";
$(document).ready(function() {
    $("#frequency").on('change',function(){
        var i = $(this).val();
        $("#divMonths").hide();
        if(i=="Quarterly"){
            $("#divMonths").show();
        }
    });
    $("#color").on('change',function() {
        var choiceColor = $(this).val();
        showColor(choiceColor);
     });
    $("#icon").on('change',function() {
        var icon = path + $(this).val() + ".png";
        $("#divIcon").html('<img height="100px" src="' + icon + '"/>');
     });
    function showColor(choiceColor){
        var col = "fbg-" + choiceColor;
        $("#divColor").removeClass();
        $("#divColor").addClass(col);
    }
    showColor($("#color").val());
      

});
</script>
@endsection