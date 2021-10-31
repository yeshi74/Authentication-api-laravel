<?php
    use App\Helpers\ApolloHelpers;
    function hodlbl($id,$caption,$params=array())
    {
        $checked="";
        // foreach($params['selLocations'] as $c)
        // {
        //     if($c == $id) $checked="checked";
        // }
        ?>
            <i class="fa fa-plus"></i> 
            <label><input {{$checked}} id="node-{{$id}}" name="hodloc[]" value="{{$id}}" data-id="{{$id}}" type="checkbox" /> {{$caption}}</label>
        <?php
    }
?>
@extends('layouts/contentLayoutMaster')
@section('title', 'Admin Users')
@section('content')
{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
{!! Helper::form(array("name"=>"frm","action"=>"admin/adminusers/update","validate"=>"Yes"))!!}
{!! Helper::hidden(array("name"=>"action","value"=>"update"))!!}
{!! Helper::hidden(array("name"=>"id","value"=>$id))!!}
{!! Helper::button(array("colspan"=>12,"name"=>"btnUpdate","label"=>"Update","type"=>"button")) !!}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
<div class="row">
    {!!Helper::display(array("colspan"=>3,"label"=>"Email","name"=>"email","class"=>"validate[required,custom[email]]","value"=>$results['email']))!!}
    {!!Helper::display(array("colspan"=>3,"label"=>"Name","name"=>"name","max"=>150,"class"=>"validate['required']","value"=>$results['name']))!!}
    {!! Helper::display(array("colspan"=>2,"label"=>"Employee Code","max"=>150,"name"=>"emp_code","class"=>"validate[required]","value"=>$results['emp_code']))!!}
  {!! Helper::display(array("colspan"=>2,"label"=>"Mobile","name"=>"mobile","value"=>$results['mobile'],"class"=>"validate[required,custom[number]]"))!!}
   {!! Helper::selectStatus(array("colspan"=>2,"label"=>"Status","name"=>"status","value"=>$results['status'])) !!}
</div> 
<div class="row">
    {!! Helper::select(array("colspan"=>3,"label"=>"Gender","name"=>"gender","value"=>$results['gender'],"options"=>array("Male"=>"Male","Female"=>"Female"))) !!}
    {!! Helper::listLocations(array("colspan"=>3,"label"=>"Def. Location","name"=>"location","blank"=>"Yes","multiple"=>"No","class"=>"validate['required']","value"=>$results['location']))!!}
  {!! Helper::selectList(array("colspan"=>3,"label"=>"Def. Role","name"=>"role","blank"=>"Yes","options"=>$getRole,"key"=>"id","val"=>"name","value"=>$results['role']))!!}
  {!! Helper::selectList(array("colspan"=>3,"label"=>"Department","name"=>"dept","blank"=>"Yes","options"=>$getDepartment,"value"=>$results['dept'],"key"=>"id","val"=>"name"))!!}
</div>

<div class="row">
  <div class="col-md-4">
  @if($results['profile'] != "")
    <label>Existing Profile Image</label><br/><img src="{{$results['profile']}}"/>
  @else
    <label>No profile image</label>
  @endif
</div>
  {!! Helper::textbox(array("colspan"=>8,"label"=>"Profile","name"=>"profile","typ"=>"file"))!!}
  </div>
  <div class="row">
    <div class="col-md-12">
       <input type="checkbox" name="is_hod" id="is_hod" value="1" <?php if($results['is_hod'] == 1) echo "checked"; ?>>Is HOD?
    </div>
  </div>


<div class="accordion" id="accView">
  {!! Helper::accordion(array("id"=>"c0","parent"=>"accView","label"=>"Admin Privileges"))!!}
  <div class="row">
    <div class="col-md-12">
      <input type="checkbox" name="is_admin" id="is_admin" value="1" <?php if($results['is_admin'] == 1) echo "checked"; ?>>Is Admin?
      <div id="divPerms" style="<?php if($results['is_admin'] == 0) echo 'display:none;' ?>">
        <div class="row">
          <div class="col-md-12">
            <legend>Permissions</legend>
            @foreach($lstOpts as $row)
              @if($row['parent']=="MAIN")
                <div class="row">
                  <div class="col-md-12">
                    <strong>{{$row->name}}</strong><br>
                    @foreach($lstOpts as $srow)
                      @if($srow['parent'] == $row['optid'])
                        <?php 
                          $checked="";
                          foreach($lstUserOpts as $c):
                              if($c['optid'] == $srow['optid']) $checked="checked";
                          endforeach;
                        ?>
                        <input {{$checked}} type="checkbox" name="opts[]" value="{{$srow->optid}}">{{$srow->name}}&nbsp;
                      @endif
                    @endforeach
                  </div>
                </div>
              @endif
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
  {!! Helper::closeAccordion() !!}
  {!! Helper::accordion(array("id"=>"c1","parent"=>"accView","label"=>"Additional Locations & Roles"))!!}
  <div class="row">
    <div class="col-md-12">
      <?php echo ApolloHelpers::locationTree(array("name"=>"locations","mode"=>"EDIT","selLocations"=>$lstLocations,"selRoles"=>$lstRoles)); ?>
    </div>
  </div>

  {!! Helper::close("form")!!}
  {!! Helper::closeAccordion() !!}
  <?php $h=0;
  if($h==1){
    ?>
  {!! Helper::accordion(array("id"=>"c2","parent"=>"accView","label"=>"HOD Privileges"))!!}
    {!! Helper::form(array("name"=>"frmHOD","action"=>"admin/adminusers/update-hod-loc"))!!}
    {!! Helper::hidden(array("name"=>"id","value"=>$id))!!}
    {!! Helper::hidden(array("name"=>"hoddept","value"=>"")) !!}
    <div class="row">
      <div class="col-md-12">
        <input type="checkbox" name="is_hod" id="is_hod" value="1" <?php if($results['is_hod'] == 1) echo "checked"; ?>>Is HOD?
        <div id="divHOD" style="<?php if($results['is_hod'] == 0) echo 'display:none;' ?>">
          <div class="row">
            <div class="col-md-8">
              <select name="hod_dept" id="hod_dept" class="form-control">
                <option value=""></option>
                @foreach($getDepartment as $row)
                  <option value="{{$row->id}}">{{$row->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-2">
              <button type="button" class="btn btn-primary" id="btnHODFilter">Filter</button>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              
              <div id="hod_treeview_container" class="hummingbird-treeview well h-scroll-large">
                <ul id="hod_treeview" class="hummingbird-base">
                </ul>
              </div>
              <button type="button" class="btn btn-warning" id="btnHODUpdate">Update</button>
            </div>
          </div>
        </div> <!-- end of hod div -->
      </div>
    </div>
    {!! Helper::close("form")!!}
  {!! Helper::closeAccordion() !!}
  <?php } ?>
</div>
{!! Helper::closePage() !!}
<!-- // Basic Floating Label Form section end -->
@endsection

@section('myscript')
<script>
  $("#btnHODFilter").on('click',function(){
    var dept = $("#hod_dept").val();
    if(dept != ""){
      var uURL = "{{url('admin/adminusers/hodlocations/')}}";
      uURL = uURL + '/<?php echo $id ?>/' + dept + "/edit";
      $("#hoddept").val(dept);
      $.ajax({
              url: uURL,
              type: 'GET',
              //data: formData,
              success: function (data) {
                $('#hod_treeview').html(data);
                $("#hod_treeview").hummingbird();
              }
          });
    }
  });
  $("#btnHODUpdate").on('click',function(){
    var uURL = "{{url('admin/adminusers/update-hod-loc')}}";
    var formData = $("#frmHOD").serialize();
    $.ajax({ url: uURL, type: 'POST', data: formData,
              success: function (data) {
                 
              }
          });
  });
   $("#btnUpdate").on('click',function()
  {
    $("#frm").submit();
  });
   $("#is_admin").on('change',function(){
    $("#divPerms").hide();
    if($(this).is(":checked")){
      $("#divPerms").show();
    }
  
   })
    $("#is_hod").on('change',function(){
    $("#divHOD").hide();
    if($(this).is(":checked")){
      $("#divHOD").show();
    }
  
   })
  var imgSize=0;
	var maxFileLimit = 2 * 1024 * 1024; //2MB Max Size
	$('#profile').bind('change', function() {
	imgSize = this.files[0].size;
	});
	$("#frm").submit(function(event){
	if(imgSize > maxFileLimit)
	{
		alert("Invalid Image Size");
		event.preventDefault();  
	}
	return;
	});
  $("#hod_treeview").hummingbird();
</script>
@endsection