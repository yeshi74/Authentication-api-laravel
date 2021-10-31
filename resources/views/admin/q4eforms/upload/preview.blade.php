@extends('layouts/contentLayoutMaster')
@section('mystyle')
@endsection
@section('title', 'Q4E Forms')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
    @include('admin/q4eforms/upload/formview')
    {!!Helper::form(array("name"=>"frm","action"=>"admin/q4eforms/".$ftype."/upload/publish","validate"=>"Yes"))!!}
    {!!Helper::hidden(array("name"=>"ftype","value"=>$ftype))!!}
    {!!Helper::hidden(array("name"=>"id","value"=>$id))!!}
    <h4>Sections & Items</h4>
    <div class="accordion" id="accView">
    <?php $sectionID = 1; ?>
    @foreach($lstSections as $row)
        <?php
            $cnt=0;
            foreach($lstItems as $irow) {
                if($irow->section_id == $row->id) $cnt++;
            }
            $label = $row['name']. " (".$cnt." Items)";
        ?>
        {!! Helper::accordion(array("id"=>"c".$sectionID,"parent"=>"accView","label"=>$label)) !!}
        <?php $ctr=1; ?>
        @foreach($lstItems as $irow)
            @if($irow->section_id == $row->id)
                <div class="row">
                    <div class="col-md-12">
                        <?php echo $ctr ?>. {{$irow->name}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-stripped"> 
                            <thead>
                                <tr>
                                    <th>Label</th>
                                    <th>Value</th>
                                    <th>Include</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach($lstChoices as $crow)
                                    @if($crow->item_id == $irow->id)
                                        <?php $inc = $row->include==1 ? "Yes" : "No"; ?>
                                        <tr>
                                            <td>{{$crow->label}}</td>
                                            <td>{{$crow->val}}</td>
                                            <td>{{$inc}}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php $ctr++; ?>
            @endif
        @endforeach
        {!! Helper::closeAccordion() !!}
        <?php $sectionID++; ?>
    @endforeach 
    </div>
    {!!Helper::button(array("colspan"=>12,"name"=>"btnSave","label"=>"Publish","type"=>"submit"))!!}
    {!!Helper::close("form")!!}
    {!! Helper::closePage()!!}
@endsection
@section('myscript')
<script>

</script>
@endsection