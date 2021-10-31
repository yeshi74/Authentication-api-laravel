<div class="row match-height" id="divGallery">
<?php $ctr=1;
$last = count($lstGallery); ?>
  @foreach($lstGallery as $row)
    <div id="divGallery{{$row['id']}}" class="col-md-4">
  <div class="card">
    <div class="card-header mb-1">
      <h4 class="card-title">{{$row['caption']}}</h4>
      @if($params['mode'] == "SET")
      <?php if($ctr==1 && $params['img'] == 0) $params['img'] = $row['id'];
        $checked = $params['img'] == $row['id'] ? " checked" : "" ;
        ?>
      <input {{$checked}} type="radio" name="setImage" id="setImage" value="{{$row['id']}}">
      @endif
    </div>
    <div class="card-content" style="text-align:center" >
      <?php
        switch(strtoupper($row['file_type'])):
          case "IMAGE":
            ?>
              <a href="{{$row['view']}}" class="colorbox"><img class="img-fluid" src="{{$row['url']}}" alt="{{$row['caption']}}"></a>
            <?php 
            break;
            
          default:
            ?>
              <div style="padding:80px;">
                <a href="{{$row['url']}}" target="_new"><img src="{{$row['icon']}}"></i></a>
              </div>
            <?php 
              break;
        endswitch;
      ?>
    </div>
    <div class="card-footer text-muted">
      <span class="float-left">{{$row['file_name']}}<br><small>{{date('d/m/Y H:i',strtotime($row['updated_at']))}}</small></span>
      <span class="float-right">
        @if($params['mode']=="EDIT")
          <a href="Javascript:void(0)" class="card-link lnkDeleteGallery" data-id="{{$row['id']}}"><i class="fa fa-trash-o"></i></a>
          @if($ctr != 1)
          <a href="Javascript:void(0)" class="card-link lnkOrderGalleryUp" data-id="{{$row['id']}}"><i class="fa fa-arrow-up"></i></a>
          @endif
          @if($ctr != $last)
          <a href="Javascript:void(0)" class="card-link lnkOrderGalleryDown" data-id="{{$row['id']}}"><i class="fa fa-arrow-down"></i></a>
          @endif
        @endif
      </span>
    </div>
  </div>
</div>
	<?php $ctr++;?>      
  @endforeach
</div>