
@extends('layouts/contentLayoutMaster')
@section('title', 'Q4e Forms')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
    {!!Helper::form(array("name"=>"frm","action"=>"admin/q4eforms/deleteSection","validate"=>"Yes"))!!}
    {!!Helper::hidden(array("name"=>"id","value"=>$id))!!}
    <div class="row">
        <div class="col-md-12">
            {!!Helper::button(array("name"=>"btnSectionEdit","label"=>"Edit","type"=>"button"))!!}
            {!!Helper::button(array("name"=>"btnSectionDel","label"=>"Delete","type"=>"button","class"=>"btn-warning"))!!}
        </div>
    </div>
    {!!Helper::close("form")!!}
    <h4>{{$results->name}}</h4>
    <div class="row">
        {!!Helper::display(array("colspan"=>4,"label"=>"Form","name"=>"name","value"=>$results['formname'],"class"=>"validate[required]","max"=>50))!!}
        {!!Helper::display(array("colspan"=>4,"label"=>"Rating Type","name"=>"name","value"=>$results['ratingname'],"class"=>"validate[required]","max"=>50))!!}
        {!!Helper::display(array("colspan"=>4,"label"=>"Answer Type","name"=>"name","value"=>$results['answername'],"class"=>"validate[required]","max"=>50))!!}
    </div>
    
    <legend>Fields</legend>
    <div class="row">
        <div class="col-md-12">
            {!! Helper::button(array("name"=>"btnAddField","label"=>"Add Field"))!!}
        </div>
    </div>
     <div class="row">
        <div class="col-md-12">
            <div class="table responsive">
                <table class="table table-striped dataex-html5-selectors">
                    <thead>
                        <tr>
                            <th>Question</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($lstItems as $row)
                        <?php 
                            $statusName = $row->status == 0 ? "Active" : "Suspend"; 
                        ?>
                        <tr>
                            <td>{!! $row['name'] !!}</a></td>
                            <td>{!! $row['typ'] !!}</td>
                            <td>{!! $statusName !!}</td>
                            <td>
                                <a href="Javascript:void(0)" data-id="{{$row['id']}}" data-name="{{$row['name']}}" data-typ="{{$row['typ']}}" data-status="{{$row['status']}}" data-ord="{{$row['ord']}}" class="lnkEditItems"><i class="fa fa-pencil"></i></a>
                            </td>
                        </tr>
                    <?php
                        endforeach;
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade text-left" id="modalAddField" tabindex="-1" role="dialog" aria-labelledby="myAddBUlabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myAddBUlabel">Add Item</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!!Helper::form(array("name"=>"frm","action"=>"admin/q4eforms/saveItem","validate"=>"Yes"))!!}
                {!!Helper::hidden(array("name"=>"id","id"=>"hdfBUID","value"=>$formID))!!}
                {!!Helper::hidden(array("name"=>"sectionid","id"=>"hdfSection","value"=>$id))!!}
                <div class="modal-body">
                    {!! Helper::textbox(array("colspan"=>12,"label"=>"Name","id"=>"itemName","name"=>"name","placeholder"=>"Enter Section Name","class"=>" validate[required]","required"=>"Yes","value"=>""))!!}
                    <div class="row">
                        {!!Helper::selectStatus(array("name"=>"status","placeholder"=>"Enter Status","colspan"=>4,"label"=>"Status","class"=>"validate[required]"))!!}
                        {!! Helper::select(array("name"=>"typ","placeholder"=>"Enter Type","colspan"=>4,"label"=>"Type","required"=>"Yes","class"=>"validate[required]","options"=>array("SELECT"=>"SELECT","TEXT"=>"TEXT","DATE"=>"DATE","TEXTAREA"=>"TEXTAREA"))) !!}
                         {!! Helper::textbox(array("colspan"=>4,"label"=>"Display Order","id"=>"sectionOrd","name"=>"ord","typ"=>"Number","required"=>"Yes"))!!}
                    </div>
                     

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
                {!! Helper::close("form") !!}
            </div>
        </div>
    </div>


    <div class="modal fade text-left" id="modalEditField" tabindex="-1" role="dialog" aria-labelledby="myAddBUlabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myAddBUlabel">Edit Item</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!!Helper::form(array("name"=>"frm","action"=>"admin/q4eforms/updateItem","validate"=>"Yes"))!!}
                {!!Helper::hidden(array("name"=>"id","id"=>"hdfItemID","value"=>""))!!}
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
                {!!Helper::form(array("name"=>"frm","action"=>"admin/q4eforms/updateSection","validate"=>"Yes"))!!}
                {!!Helper::hidden(array("name"=>"id","value"=>$id))!!}

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


