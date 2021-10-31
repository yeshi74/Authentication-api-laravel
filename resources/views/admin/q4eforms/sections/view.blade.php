@extends('layouts/contentLayoutMaster')
@section('title', 'Q4e Forms')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
    {!!Helper::form(array("name"=>"frm","action"=>"admin/q4eforms/".$ftype."/deleteSection","validate"=>"Yes"))!!}
    {!!Helper::hidden(array("name"=>"id","value"=>$id))!!}
    {!!Helper::hidden(array("name"=>"ftype","value"=>$ftype))!!}
    <div class="row">
        <div class="col-md-12">
            {!!Helper::linkButton(array("url"=>url('admin/q4eforms/'.$ftype.'/section/edit/'.$id."/".$sectionID),"name"=>"btnEdit","label"=>"Edit Section","class"=>"btn-primary"))!!}
            {!!Helper::linkButton(array("url"=>url('admin/q4eforms/'.$ftype.'/section/items/add/'.$id."/".$sectionID),"label"=>"Add Item","class"=>"btn-primary"))!!}
        </div>
    </div>
    {!!Helper::close("form")!!}
    <div class="row">
        <div class="col-md-10">
            <h4>{{ $results['formname'] }} > {{$results['name']}}</h4>
        </div>
        <div class="col-md-2">
            @if($results['status'] == 0)
                Active
            @else
                Suspended
            @endif
        </div>
    </div>
    {!! Helper::display(array("colspan"=>12,"label"=>"Caption","value"=>$results['header1'])) !!}
    {!! Helper::display(array("colspan"=>12,"label"=>"Sub Caption","value"=>$results['header2'])) !!}
    {!! Helper::display(array("colspan"=>12,"label"=>"Footer","value"=>$results['Footer'])) !!}
    <div class="row">
        {!! Helper::display(array("colspan"=>3,"label"=>"Display Order","value"=>$results['ord'])) !!}
        {!! Helper::display(array("colspan"=>3,"label"=>"Max. Value","value"=>$results['max_value'])) !!}
    </div>
   
     
            
    <legend>Fields</legend>
    <div class="row">
        <div class="col-md-12">
            
        </div>
    </div>
    {!! Helper::responsiveTable(array("Title","Caption","Type","Status",""))!!}
    @foreach($lstItems as $row)
        <?php 
            $statusName = $row->status == 0 ? "Active" : "Suspend"; 
        ?>
        <tr>
            <td><a href="{{url('admin/q4eforms/'.$ftype.'/section/items/view/'.$id.'/'.$sectionID.'/'.$row['id'])}}">{!! $row['name'] !!}</a></td>
            <td>{!! $row['header'] !!}</a></td>
            <td>{!! $row['typ'] !!}</td>
            <td>{!! $statusName !!}</td>
        </tr>
    @endforeach
    {!! Helper::closeResponsiveTable()!!}

    <div class="modal fade text-left" id="modalEditField" tabindex="-1" role="dialog" aria-labelledby="myAddBUlabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myAddBUlabel">Edit Item</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!!Helper::form(array("name"=>"frm","action"=>"admin/q4eforms/".$ftype."/updateItem","validate"=>"Yes"))!!}
                {!!Helper::hidden(array("name"=>"id","id"=>"hdfItemID","value"=>""))!!}
                {!!Helper::hidden(array("name"=>"ftype","value"=>$ftype))!!}
                {!!Helper::hidden(array("name"=>"section","id"=>"hdfSectionID","value"=>$id))!!}
                <div class="modal-body">
                    {!! Helper::textbox(array("colspan"=>12,"label"=>"Name","id"=>"editName","name"=>"name","placeholder"=>"Enter Section Name","class"=>" validate[required]","required"=>"Yes","value"=>""))!!}
                    <div class="row">
                        {!!Helper::selectStatus(array("name"=>"status","id"=>"editStatus","placeholder"=>"Enter Status","colspan"=>4,"label"=>"Status","class"=>"validate[required]"))!!}
                        {!! Helper::select(array("name"=>"typ","id"=>"editTyp","placeholder"=>"Enter Type","colspan"=>4,"label"=>"Type","required"=>"Yes","class"=>"validate[required]","options"=>array("SELECT"=>"SELECT","TEXT"=>"TEXT","DATE"=>"DATE","TEXTAREA"=>"TEXTAREA"))) !!}
                         {!! Helper::textbox(array("colspan"=>4,"label"=>"Display Order","id"=>"editOrd","name"=>"ord","typ"=>"Number","required"=>"Yes"))!!}
                    </div>
                     

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                {!! Helper::close("form") !!}
            </div>
        </div>
    </div>

    <!-- Edit Section -->
    <div class="modal fade text-left" id="modalEditSection" tabindex="-1" role="dialog" aria-labelledby="myAddBUlabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myAddBUlabel">Edit Section</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!!Helper::form(array("name"=>"frm","action"=>"admin/q4eforms/".$ftype."/updateSection","validate"=>"Yes"))!!}
                {!!Helper::hidden(array("name"=>"id","value"=>$id))!!}
                {!!Helper::hidden(array("name"=>"ftype","value"=>$ftype))!!}

                <div class="modal-body">
                    {!! Helper::textbox(array("colspan"=>12,"label"=>"Name","id"=>"sectionName","name"=>"name","placeholder"=>"Enter Section Name","class"=>" validate[required]","required"=>"Yes","value"=>$results['name']))!!}
                    <div class="row">
                        {!! Helper::textbox(array("colspan"=>3,"label"=>"Display Order","id"=>"sectionOrd","name"=>"ord","typ"=>"Number","required"=>"Yes","value"=>$results['ord']))!!}
                        {!! Helper::selectList(array("name"=>"rating_typ","colspan"=>9,"label"=>"Type","required"=>"Yes","class"=>"validate[required]","id"=>"sectionType",
                                "options"=>$lstType,"key"=>"id","val"=>"name","value"=>$results['rating_typ'])) !!}
                    </div>
                    <div class="row">
                        {!! Helper::selectList(array("name"=>"answer_type","colspan"=>12,"label"=>"Answer Options","required"=>"Yes","class"=>"validate[required]","id"=>"sectionAnswerType",
                                "options"=>$lstAnswerTypes,"key"=>"id","val"=>"name","value"=>$results['answer_type'])) !!}
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                {!! Helper::close("form") !!}
            </div>
        </div>
    </div>
    {!! Helper::closePage()!!}
      
@endsection
@section('myscript')
    <script>
        $("#btnAddField").on('click',function()
        {
            $("#modalAddField").modal('show');
        });
        $("#btnSectionEdit").on('click',function()
        {
            $("#modalEditSection").modal('show');
        });
        $("#btnSectionDel").on('click',function(){
            if(confirm("Are you sure you want to delete this section?")){
                $("#frm").submit();
            }
        });
        $(".lnkEditItems").on('click',function()
        {
            var id = $(this).data("id");
            var name = $(this).data("name");
            var typ = $(this).data("typ");
            var status = $(this).data("status");
            var ord = $(this).data("ord");
            $("#hdfItemID").val(id);
            $("#editName").val(name);
            $("#editStatus").val(status);
            $("#editTyp").val(typ);
            $("#editOrd").val(ord);

            $("#modalEditField").modal('show');
        });

    </script>
@endsection


