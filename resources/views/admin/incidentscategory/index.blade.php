@extends('layouts/contentLayoutMaster')
@section('title', 'Incidents Category')
@section('content')
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>"")) !!}
    {!! Helper::form(array("name"=>"frm","action"=>"admin/incidents/view")) !!}
    {!! Helper::hidden(array("name"=>"action","value"=>"view"))!!}
    {!! Helper::hidden(array("name"=>"id","value"=>""))!!}
    <?php
    function lbl($id,$caption,$status,$params)
    {
        $checked="";
        // foreach($params['selLocations'] as $c)
        // {
        //     if($c == $id) $checked="checked";
        // }
        $disabled = $params['mode'] == "VIEW" ? " disabled" : "";
        ?>
            <i class="fa fa-plus"></i> 
            <label> @if($status == 1)
                    <span style="color:red;"><i class="fa fa-exclamation"></i></span>
                @endif
                 <a href="{{url('admin/incidents-category/view/'.$id)}}">{{$caption}}</a>
               
            </label>
        <?php
    }
?>
    <div class="row">
        <div class="col-md-12">
            {!! Helper::linkButton(array("url"=>url('admin/incidents-category/add'),"btnAdd","label"=>"Add","class"=>"btn btn-primary"))!!}
        </div>
    </div>
    <div id="treeview_container" class="hummingbird-treeview well h-scroll-large">

      <div class="row">
        <div class="col-md-12">
          <ul id="treeview" class="hummingbird-base">
            @foreach($lstCategory as $row)
              @if($row->typ == 'CATEGORY' && $row->parent == 0)
                <li>
                  <?php lbl($row->id,$row->caption,$row->status,$params); ?>
                  <ul>
                    @foreach($lstCategory as $row1)
                        @if($row1->parent == $row->id && $row1->typ=="GROUP")
                            <li>
                                <?php lbl($row1->id,$row1->caption,$row1->status,$params); ?>
                                <ul>
                                    @foreach($lstCategory as $row2)
                                        @if($row2->parent == $row1->id && $row2->typ=="ITEM")
                                            <li>
                                                <?php lbl($row2->id,$row2->caption,$row2->status,$params); ?>
                                            </li> 
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    @endforeach
                    @foreach($lstCategory as $row1)
                        @if($row1->parent == $row->id && $row1->typ=="ITEM")
                            <li>
                                <?php lbl($row1->id,$row1->caption,$row->status,$params); ?>
                               
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
     
    {!! Helper::close("form")!!}
    {!! Helper::closePage() !!}
@endsection
@section('myscript')
<script>
$(document).ready(function(){
    $("#treeview").hummingbird();
     
});
</script>
@endsection
