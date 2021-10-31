<div id="divGallery{{$imgResults['id']}}" class="col-md-4">
  <div class="card">
    <div class="card-header mb-1">
      <h4 class="card-title">{{$imgResults['caption']}}</h4>
    </div>
    <div class="card-content" style="text-align:center" >
      <?php
        switch(strtoupper($imgResults['file_type'])):
          case "IMAGE":
            ?>
              <a href="{{$imgResults['view']}}" class="colorbox"><img class="img-fluid" src="{{$imgResults['url']}}" alt="{{$imgResults['caption']}}"></a>
            <?php 
            break;
            
          default:
            ?>
              <div style="padding:80px;">
                <a href="{{$imgResults['url']}}" target="_new"><i class="fa {{$imgResults['icon']}} fa-5x"></i></a>
              </div>
            <?php 
              break;
        endswitch;
      ?>
    </div>
    <div class="card-footer text-muted">
      <span class="float-left">{{$imgResults['file_name']}}<br><small>{{date('d/m/Y',strtotime($imgResults['updated_at']))}}</small></span>
      <span class="float-right">
        @if($mode=="EDIT")
          <a href="Javascript:void(0)" class="card-link lnkDeleteGallery" data-id="{{$imgResults['id']}}"><i class="fa fa-trash-o"></i></a>
          @if($ctr != 1)
          <a href="Javascript:void(0)" class="card-link lnkOrderGalleryUp" data-id="{{$imgResults['id']}}"><i class="fa fa-arrow-up"></i></a>
          @endif
          @if($ctr != $last)
          <a href="Javascript:void(0)" class="card-link lnkOrderGalleryDown" data-id="{{$imgResults['id']}}"><i class="fa fa-arrow-down"></i></a>
          @endif
        @endif
      </span>
    </div>
  </div>
</div>