@extends('layouts/contentLayoutMaster')
@section('title', 'Locations')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>"Locations")) !!}
    <div class="row">
        <div class="col-md-4">
            {!! Helper::button(array("name"=>"btnAddBU","type"=>"button","label"=>"Add New BU")) !!}
            <ul class="list-group">
                @foreach($lstBU as $row)
                    @if($row->id == $bu)
                        <li class="list-group-item d-flex active">
                            <p class="float-left mb-0">
                                <a href="Javascript:void(0)" class="lnkEditBU" data-id="{{$row->id}}" data-name="{{$row->name}}" style="color:white"><i class="fa fa-pencil mr-1"></i></a>
                            </p>
                            <span>{{$row->name}}</span>
                        </li>
                    @else
                        <li class="list-group-item d-flex">
                            <p class="float-left mb-0">
                                <a href="Javascript:void(0)" class="lnkEditBU" data-id="{{$row->id}}" data-name="{{$row->name}}"><i class="fa fa-pencil mr-1"></i></a>
                            </p>
                            <span><a href="{{url('admin/locations/region/'.$row->id)}}">{{$row->name}}</a></span>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
        <div class="col-md-4">
            @if($bu != "")
                {!! Helper::button(array("name"=>"btnAddRegion","type"=>"button","label"=>"Add New Region")) !!}
            @endif
            @if(count($lstRegions) > 0)
                <ul class="list-group">
                    @foreach($lstRegions as $row)
                        @if($row->id == $region)
                            <li class="list-group-item d-flex active">
                                <p class="float-left mb-0">
                                    <a href="Javascript:void(0)" class="lnkEditRegion" data-id="{{$row->id}}" data-name="{{$row->name}}" style="color:white"><i class="fa fa-pencil mr-1"></i></a>
                                </p>
                                <span>{{$row->name}}</span>
                            </li>
                        @else
                            <li class="list-group-item d-flex">
                                <p class="float-left mb-0">
                                    <a href="Javascript:void(0)" class="lnkEditRegion" data-id="{{$row->id}}" data-name="{{$row->name}}"><i class="fa fa-pencil mr-1"></i></a>
                                </p>
                                <span><a href="{{url('admin/locations/center/'.$bu."/".$row->id)}}">{{$row->name}}</a></span>
                            </li>
                        @endif
                         
                    @endforeach
                </ul>
            @endif
        </div>
        <div class="col-md-4">
            @if($region != "")
                {!! Helper::button(array("name"=>"btnAddCenter","type"=>"button","label"=>"Add New Center")) !!}
            @endif
            @if(count($lstCenter) > 0)
                
                <ul class="list-group">
                    @foreach($lstCenter as $row)
                        <li class="list-group-item d-flex">
                            <p class="float-left mb-0">
                                <a href="Javascript:void(0)" class="lnkEditCenter" data-id="{{$row->id}}" data-name="{{$row->name}}"><i class="fa fa-pencil mr-1"></i></a>
                            </p>
                            <span>{{$row->name}}</span>
                        </li>
                    @endforeach
                    
                </ul>
            @endif
        </div>
    </div>
    <!-- Add BU -->
    <div class="modal fade text-left" id="modalAddBU" tabindex="-1" role="dialog" aria-labelledby="myAddBUlabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myAddBUlabel">Add BU</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!!Helper::form(array("name"=>"frm","action"=>"admin/locations/add/bu","validate"=>"Yes"))!!}
                {!!Helper::hidden(array("name"=>"action","id"=>"hdfBUAction","value"=>"save"))!!}
                {!!Helper::hidden(array("name"=>"buid","id"=>"hdfBUID","value"=>""))!!}

                <div class="modal-body">
                    {!! Helper::textbox(array("colspan"=>12,"label"=>"BU","id"=>"buName","name"=>"name","placeholder"=>"Enter BU Name","required"=>"Yes","class"=>"validate[required]")) !!}
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                {!! Helper::close("form") !!}
            </div>
        </div>
    </div>
    <!-- Add Region -->
    <div class="modal fade text-left" id="modalAddRegion" tabindex="-1" role="dialog" aria-labelledby="myAddRegionlabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myAddRegionlabel">Add Region</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!!Helper::form(array("name"=>"frm","action"=>"admin/locations/add/region","validate"=>"Yes"))!!}
                {!!Helper::hidden(array("name"=>"action","id"=>"hdfRegionAction","value"=>"save"))!!}
                {!!Helper::hidden(array("name"=>"regionid","id"=>"hdfRegionID","value"=>""))!!}
                {!! Helper::hidden(array("name"=>"bu","value"=>$bu))!!}
                <div class="modal-body">
                    {!! Helper::textbox(array("colspan"=>12,"label"=>"Region","id"=>"regionName", "name"=>"name","placeholder"=>"Enter Region Name","required"=>"Yes","class"=>"validate[required]")) !!}
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                {!! Helper::close("form") !!}
            </div>
        </div>
    </div>
    <!-- Add Center -->
    <div class="modal fade text-left" id="modalAddCenter" tabindex="-1" role="dialog" aria-labelledby="myAddCenterLbl" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myAddCenterLbl">Add Center</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!!Helper::form(array("name"=>"frm","action"=>"admin/locations/add/center","validate"=>"Yes"))!!}
                {!! Helper::hidden(array("name"=>"bu","value"=>$bu))!!}
                {!! Helper::hidden(array("name"=>"region","value"=>$region))!!}
                {!!Helper::hidden(array("name"=>"action","id"=>"hdfCenterAction","value"=>"save"))!!}
                {!!Helper::hidden(array("name"=>"centerid","id"=>"hdfCenterID","value"=>""))!!}
                <div class="modal-body">
                    {!! Helper::textbox(array("colspan"=>12,"label"=>"Center","id"=>"centerName","name"=>"name","placeholder"=>"Enter Center Name","required"=>"Yes","class"=>"validate[required]")) !!}
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                {!! Helper::close("form") !!}
            </div>
        </div>
    </div>
    {!! Helper::closePage() !!}
</section>
@endsection
@section('myscript')
<script>
$("#btnAddBU").on('click',function(){
    $("#myAddBUlabel").html("Add BU");
    $("#hdfBUAction").val("save");
    $("#hdbBUID").val("");
    $("#buName").val("");
    $("#modalAddBU").modal('show');
});
$("#btnAddRegion").on('click',function(){
    $("#myAddRegionlabel").html("Add Region");
    $("#hdfRegionAction").val("save");
    $("#hdfRegionID").val("");
    $("#regionName").val("");
    $("#modalAddRegion").modal('show');
});
$("#btnAddCenter").on('click',function(){
    $("#myAddCenterLbl").html("Add Center");
    $("#hdfCenterAction").val("save");
    $("#hdfCenterID").val("");
    $("#centerName").val("");
    $("#modalAddCenter").modal('show');
});
$(".lnkEditBU").on('click',function(){
    $("#myAddBUlabel").html("Edit BU");
    $("#hdfBUAction").val("update");
    var id = $(this).data("id");
    var name = $(this).data("name");
    $("#hdfBUID").val(id);
    $("#buName").val(name);
    $("#modalAddBU").modal('show');
});
$(".lnkEditRegion").on('click',function(){
    $("#myAddRegionlabel").html("Edit Region");
    $("#hdfRegionAction").val("update");
    var id = $(this).data("id");
    var name = $(this).data("name");
    $("#hdfRegionID").val(id);
    $("#regionName").val(name);
    $("#modalAddRegion").modal('show');
});
$(".lnkEditCenter").on('click',function(){
    $("#myAddCenterLbl").html("Edit Center");
    $("#hdfCenterAction").val("update");
    var id = $(this).data("id");
    var name = $(this).data("name");
    $("#hdfCenterID").val(id);
    $("#centerName").val(name);
    $("#modalAddCenter").modal('show');
});
</script>
@endsection

 