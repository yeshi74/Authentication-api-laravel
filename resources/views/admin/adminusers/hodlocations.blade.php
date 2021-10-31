<?php
  function hodlbl($id,$caption,$selLocations,$mode)
  {
    $checked="";
    foreach($selLocations as $c)
    {
      if($c->location == $id) $checked="checked";
    }
    $disabled = $mode=="view" ? " disabled" : "";
    ?>
      <i class="fa fa-plus"></i> 
      <label><input {{$disabled}} {{$checked}} id="node-{{$id}}" name="hodloc[]" value="{{$id}}" data-id="{{$id}}" type="checkbox" /> {{$caption}}</label>
    <?php
  }
?>
@foreach($lstAllLocations as $row)
  @if($row->typ == 'BU' && $row->parent == 0)
    <li>
      <?php hodlbl($row->id,$row->name,$selLocations,$mode); ?>
      <ul>
        @foreach($lstAllLocations as $row1)
          @if($row1->parent == $row->id && $row1->typ=="REGION")
            <li>
              <?php hodlbl($row1->id,$row1->name,$selLocations,$mode); ?>
              <ul>
                @foreach($lstAllLocations as $row2)
                  @if($row2->parent == $row1->id && $row2->typ=="CENTER")
                    <li>
                      <?php hodlbl($row2->id,$row2->name,$selLocations,$mode); ?>
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