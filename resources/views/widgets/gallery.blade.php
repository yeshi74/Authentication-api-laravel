@if($params['mode'] == "EDIT")
  <legend>{{$lstSettings->caption}}</legend>
  <div class="row">
      {!!Helper::button(array("colspan"=>4,"name"=>"btnAddAlbum","label"=>$lstSettings->btnAdd,"type"=>"button","class"=>" btn btn-primary"))!!}
  </div>
  <div id="addGallery" style="display:none;">
    {!! Helper::form(array("name"=>"frmUploadFiles","action"=>"admin/file/upload","validate"=>"Yes"))!!}
    {!! Helper::hidden(array("name"=>"module","value"=>$params['module'])) !!}
    {!! Helper::hidden(array("name"=>"id","value"=>$id))!!}
    <br/>
    <div class="row">
      {!! Helper::textbox(array("colspan"=>6,"label"=>"Attachment","name"=>"file","placeholder"=>"Choose File","required"=>"Yes","class"=>"uploadImage validate[required]","typ"=>"FILE")) !!}
      {!!Helper::textbox(array("colspan"=>6,"label"=>"Caption","name"=>"caption","placeholder"=>"Enter Caption","required"=>"Yes","value"=>"","max"=>150))!!}
    </div>
    <div class="row">
      {!! Helper::button(array("colspan"=>12,"name"=>"btnAddImageToGallery","class"=>"btn btn-primary","label"=>$lstSettings->btnSave,"type"=>"submit"))!!}
    </div>
    {!! Helper::close("form")!!}
    {!! Helper::form(array("name"=>"frmDeleteGalleryFile","action"=>"admin/file/delete"))!!}
    {!! Helper::hidden(array("name"=>"module","value"=>$params['module'])) !!}
    {!! Helper::hidden(array("name"=>"id","value"=>$id))!!}
    {!! Helper::hidden(array("name"=>"fileid","id"=>"hdfFileID","value"=>""))!!}
    {!! Helper::close("form")!!}
  </div>
@else
  <legend>{{$lstSettings->viewcaption}}</legend>
@endif
@if($params['mode']=="SET")
@else
  {!! Helper::form(array("name"=>"frmListGallery","action"=>"admin/file/list"))!!}
  {!! Helper::hidden(array("name"=>"module","value"=>$params['module'])) !!}
  {!! Helper::hidden(array("name"=>"id","value"=>$id))!!}
  {!! Helper::hidden(array("name"=>"mode","value"=>$params['mode']))!!}
  {!! Helper::close("form")!!}
@endif
<section id="sectionGallery">
{{--   <div class="spinner-border spinner-border-sm" role="status">
    <span class="sr-only">Loading...</span>
  </div> --}}
</section>
<script>
  var maxFileLimit = parseInt({{$lstSettings->filesize}}) * 1024 * 1024; //2MB Max Size
  var _checkExtension = 0;
  <?php 
    if($lstSettings->allowed_type=="*"){
        echo "_checkExtension=1;";
    }
  ?>
  var _validFileExtensions = [
    <?php 
      $ext = explode(";",$lstSettings->allowed_type);
      foreach($ext as $e)
      {
        echo '".'.$e.'",';
      }
    ?>
    ]; 
    $(document).ready(function(){
      var uURL = "{{url('admin/file/list/'.$params['module'].'/'.$id.'/'.$params['mode'])}}";

      var formData = $("#frmListGallery").serialize();
      $.ajax({
              url: uURL,
              type: 'GET',
              //data: formData,
              success: function (data) {
                $("#sectionGallery").html(data);
              }
          });
  });
</script>