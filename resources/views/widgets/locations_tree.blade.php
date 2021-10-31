<?php
    function lbl($id,$caption,$params)
    {
        $checked="";
        foreach($params['selLocations'] as $c)
        {
            if($c == $id) $checked="checked";
        }
        $disabled = $params['mode'] == "VIEW" ? " disabled" : "";
        ?>
            <i class="fa fa-plus"></i> 
            <label><input {{$disabled}} {{$checked}} id="node-{{$id}}" name="{{$params['name']}}[]" value="{{$id}}" data-id="{{$id}}" type="checkbox" /> {{$caption}}</label>
        <?php
    }
    function roleLabel($id,$caption,$params)
    {
        $checked="";
        foreach($params['selRoles'] as $c)
        {
            if($c==$id) $checked="checked";
        }
        $disabled = $params['mode'] == "VIEW" ? " disabled" : "";
        ?>
        <li><label><input {{$disabled}} {{$checked}} id="node-{{$id}}" name="roles[]" value="{{$id}}" data-id="{{$id}}" type="checkbox" class="roleChkBox" /> {{$caption}}</label></li>
        <?php
    }
?>
<div class="row">
    <div class="col-md-8">
        <label>Locations</label>
        <div id="treeview_container" class="hummingbird-treeview well h-scroll-large">
            @if($params['mode'] != "VIEW")
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" id="btnLocCheckAll" class="btn btn-icon btn-outline-primary mr-1 mb-1 waves-effect waves-light"><i class="fa fa-plus-square"></i></button>&nbsp;
                        <button type="button" id="btnLocUncheckAll" class="btn btn-icon btn-outline-primary mr-1 mb-1 waves-effect waves-light"><i class="fa fa-minus-square"></i></button>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <ul id="treeview" class="hummingbird-base">
                        @foreach($lstLocations as $row)
                            @if($row->typ == 'BU' && $row->parent == 0)
                                <li>
                                    <?php lbl($row->id,$row->name,$params); ?>
                                    <ul>
                                    @foreach($lstLocations as $row1)
                                        @if($row1->parent == $row->id && $row1->typ=="REGION")
                                            <li>
                                                <?php lbl($row1->id,$row1->name,$params); ?>
                                                <ul>
                                                    @foreach($lstLocations as $row2)
                                                        @if($row2->parent == $row1->id && $row2->typ=="CENTER")
                                                            <li>
                                                                <?php lbl($row2->id,$row2->name,$params); ?>
                                                            </li> 
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endif
                                    @endforeach
                                    </ul>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <label>Roles</label>
         @if($params['mode'] != "VIEW")
            <div class="row">
                <div class="col-md-12">
                    <button type="button" id="btnRoleCheckAll" class="btn btn-icon btn-outline-primary mr-1 mb-1 waves-effect waves-light"><i class="fa fa-plus-square"></i></button>&nbsp;
                    <button type="button" id="btnRoleUncheckAll" class="btn btn-icon btn-outline-primary mr-1 mb-1 waves-effect waves-light"><i class="fa fa-minus-square"></i></button>
                </div>
            </div>
        @endif
        <ul style="list-style:none;">
            @foreach($lstRoles as $row)
            <?php roleLabel($row->id,$row->name,$params); ?>
               
            @endforeach
        </ul>
    </div>
</div>

<script>
$(document).ready(function(){
    $("#treeview").hummingbird();
    $("#btnLocCheckAll").on("click", function(){
        $("#treeview").hummingbird("checkAll");
    });
    $("#btnLocUncheckAll").on("click", function(){
        $("#treeview").hummingbird("uncheckAll");
    });
    $("#btnRoleCheckAll").on("click", function(){
       $('.roleChkBox').prop('checked', true);
    });
    $("#btnRoleUncheckAll").on("click", function(){
      $('.roleChkBox').prop('checked', false);
    });
});
</script>