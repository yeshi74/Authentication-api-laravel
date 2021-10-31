<?php
    use App\Helpers\ApolloHelpers;
?>
@extends('layouts/contentLayoutMaster')
@section('title', 'Q4e Forms')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
    {!!Helper::form(array("name"=>"frm","action"=>"admin/q4eforms/".$ftype."/update","validate"=>"Yes"))!!}
    {!!Helper::hidden(array("name"=>"id","value"=>$id))!!}
    {!!Helper::hidden(array("name"=>"ftype","value"=>$ftype))!!}
    <div class="row">
        {!!Helper::button(array("name"=>"btnUpdate","label"=>"Update","type"=>"submit"))!!}
        @if($typCode == "OUTCOME")
            {!! Helper::linkButton(array("url"=>url('admin/q4eforms/'.$ftype.'/outcome/'.$id),"btnEdit","label"=>"Parameters","class"=>"btn btn-primary"))!!}
        @else
            {!! Helper::linkButton(array("url"=>url('admin/q4eforms/'.$ftype.'/section/add/'.$id),"btnEdit","label"=>"Sections","class"=>"btn btn-primary"))!!}
        @endif
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br/>
    @endif
    <section id="column-selectors">
        {!! Helper::textbox(array("name"=>"name","placeholder"=>"Enter Name","colspan"=>12,"label"=>"Name","required"=>"Yes","class"=>"validate[required]","max"=>50,"value"=>$results['name'])) !!}
        <div class="row">
            {!! Helper::selectList(array("name"=>"typ","placeholder"=>"Enter Type","colspan"=>3,"label"=>"Type","required"=>"Yes","class"=>"validate[required]","options"=>$lstType,"key"=>"id","val"=>"name","value"=>$results['typ'])) !!}
           {!! Helper::select(array("name"=>"frequency","placeholder"=>"Enter Frequency","colspan"=>2,"label"=>"Frequency","class"=>"","options"=>$lstFrequency,"value"=>$results['frequency'])) !!}
            {!! Helper::textbox(array("name"=>"days_submit","placeholder"=>"Enter Days to Submit","colspan"=>2,"label"=>"Days to Submit","typ"=>"NUMBER","value"=>$results['days_submit'])) !!}
            {!! Helper::selectList(array("name"=>"owner","placeholder"=>"Owner","colspan"=>3,"label"=>"Owner","required"=>"Yes","class"=>"validate[required]","options"=>$lstUsers,"key"=>"id","val"=>"name","value"=>$results['owner'])) !!}
            {!!Helper::selectStatus(array("name"=>"status","placeholder"=>"Enter Status","colspan"=>2,"label"=>"Status","class"=>"textarea validate[required]","value"=>$results['status']))!!}
        </div>
         <div class="row">
            <div class="col-md-2">
                <label>Select Color</label>
                <select id="color" name="color" class="select2 form-control colorChoice">
                    @foreach($lstColors as $c)
                        <?php for($ctr=0;$ctr<=14;$ctr++) { 
                            $v = $ctr==0 ? $c : $c."-".$ctr; 
                            $sel = $results['color'] == $v ? " selected": "";
                        ?>
                            <option {{$sel}} value="{{$v}}">{{$c}} - {{$ctr}}</option>
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
                        <?php $sel = $results['icon'] == $c ? " selected" : "";?>
                        <option {{$sel}} value="{{$c}}">{{$c}}</option>
                    @endforeach
                </select>
            </div>
             <div class="col-md-3">
                <div id="divIcon"></div>
            </div>
            @if($ftype=="outcome" || $ftype=="checklist")
                {!! Helper::textbox(array("colspan"=>3,"name"=>"max_val","typ"=>"number","label"=>"Max Value for Scoring","value"=>$results['max_val']))!!}
            @else
            {!! Helper::hidden(array("name"=>"max_val","value"=>$results['max_val']))!!}
            @endif
        </div>
        <div class="row">
            <div class="col-12 col-md-12">
                <div class="form-group">
                    <label>Applicable to BU</label>
                    <select name="bu[]" id="bu" class="select2 form-control" multiple='multiple'>
                        @foreach($lstBU as $row)
                            <?php 
                                $sel = "";
                                foreach($lstApplicableBU as $b){
                                    if($b->val == $row->id) $sel = "selected";
                                }
                            ?>
                            <option {{$sel}} value="{{$row->id}}">{{$row->name}}</option>
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
                            <?php $sel = "";
                                foreach($lstAMonths as $row1){
                                    if($row1->period == $row['id']) $sel = "selected";
                                }
                            ?>
                            <option {{$sel}} value="{{$row['id']}}">{{$row['name']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        {!! Helper::textbox(array("name"=>"header","placeholder"=>"Enter Header","colspan"=>12,"label"=>"Header","required"=>"Yes","class"=>"","max"=>100,"value"=>$results['header'])) !!}
        {!! Helper::textbox(array("name"=>"assign_msg","placeholder"=>"Message for Assignment","colspan"=>12,"label"=>"Message for Assignment","class"=>"validate[required]","value"=>$results['assign_msg'])) !!}
        {!! Helper::textbox(array("name"=>"reminder_msg","placeholder"=>"Reminder Message","colspan"=>12,"label"=>"Reminder Message","class"=>"validate[required]","value"=>$results['reminder_msg'])) !!}
        {!! Helper::textbox(array("name"=>"complete_msg","placeholder"=>"Complete Message","colspan"=>12,"label"=>"Complete Message","class"=>"validate[required]","value"=>$results['complete_msg'])) !!}
        {!! Helper::textbox(array("name"=>"thankyou_msg","placeholder"=>"Thank You Message","colspan"=>12,"label"=>"Thank You Message","class"=>"validate[required]","value"=>$results['thankyou_msg'])) !!}
    
        <?php echo ApolloHelpers::locationTree(array("name"=>"locations","mode"=>"EDIT","selLocations"=>$lstLocations,"selRoles"=>$lstRoles)); ?>
        <fieldset>
            <legend>Properties</legend>
            <table class="table table-stripped">
            @foreach($lstProps as $row)
                <tr>
                    <td>{{$row['prop']}}</td>
                    <td><input type="text" name="prop_{{$row['prop']}}" id="prop_{{$row['prop']}}" value="{{$row['val']}}" class="form-control"></td>
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
        var f = '<?php echo $results["frequency"] ?>';
        showMonths(f);
        $("#frequency").on('change',function(){
        var i = $(this).val();
        showMonths(i);
    });
    function showMonths(i)
    {
        $("#divMonths").hide();
        if(i=="Quarterly"){
            $("#divMonths").show();
        }
    }
        $("#btnAddSection").on('click',function()
        {
            $("#modalAddSection").modal('show');
        });
        $("#btnAddSection").on('click',function(){
        $("#modalAddSection").modal('show');
    });

        $("#typ").attr('disabled',true);
    </script>
    <script>
        var path = "{{$imgPath}}";
        var icon1 = "{{$results['icon']}}";
        $(document).ready(function() {
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
            if(icon1 != ""){
                 var icon = path + icon1 + ".png";
                $("#divIcon").html('<img height="100px" src="' + icon + '"/>');
            }

        });
</script>
@endsection
