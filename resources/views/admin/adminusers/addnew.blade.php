@extends('layouts/contentLayoutMaster')
@section('title', 'Admin Users')
@section('content')
  {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>"")) !!}
  {!! Helper::form(array("name"=>"frm","action"=>"admin/adminusers/save","validate"=>"Yes")) !!}
  {!! Helper::hidden(array("name"=>"action","value"=>"save")) !!}
  {!! Helper::hidden(array("name"=>"id","value"=>"")) !!}
  {!! Helper::button(array("colspan"=>12,"label"=>"Save User","name"=>"btnUpdate","class"=>"btn btn-primary btnAction","type"=>"submit"))!!}
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif 
  {{-- @if($msg != "")
	<div class="row">
		<div class="col-md-12">
			<p style="color:#c80000;">{!!$msg!!}</p>
		</div>
	</div>
  @endif --}}

  <div class="row">
		{!! Helper::textbox(array("colspan"=>4,"label"=>"Name","max"=>150,"name"=>"name","class"=>"validate[required]","value"=>old('name')))!!}
		{!! Helper::textbox(array("colspan"=>4,"label"=>"Email","name"=>"email","max"=>150,"class"=>"validate[required,custom[email]]","value"=>old('email')))!!}
		{!! Helper::textbox(array("colspan"=>4,"label"=>"Password","name"=>"password","class"=>"validate[required]","value"=>"","typ"=>"password"))!!}
  </div>

  <div class="row">
		{!! Helper::textbox(array("colspan"=>3,"label"=>"Employee Code","max"=>150,"name"=>"emp_code","class"=>"validate[required]","value"=>old('emp_code')))!!}
		{!! Helper::select(array("colspan"=>3,"label"=>"Type","name"=>"is_admin","value"=>old('is_admin'),"options"=>array("1"=>"Admin","0"=>"Normal"))) !!}
		{!! Helper::listLocations(array("colspan"=>3,"label"=>"Def. Location","name"=>"location","multiple"=>"No","value"=>old('location')))!!}
		{!! Helper::select(array("colspan"=>3,"label"=>"Gender","name"=>"gender","value"=>old('gender'),"options"=>array("Male"=>"Male","Female"=>"Female"))) !!}
  </div>
  <div class="row">
		{!! Helper::textbox(array("colspan"=>4,"label"=>"Mobile Number","name"=>"mobile","placeholder"=>"Enter Mobile Number","required"=>"Yes","class"=>"validate[required,custom[number]]","value"=>old('mobile'))) !!}
		{!! Helper::textbox(array("colspan"=>6,"label"=>"Profile Image","name"=>"profile","class"=>"validate[required]","required"=>"Yes","typ"=>"FILE")) !!}
  </div>
  <div class="class row">
		{!! Helper::selectList(array("colspan"=>4,"label"=>"Department","name"=>"dept","options"=>$getDepartment,"value"=>old('dept'),"key"=>"id","val"=>"name"))!!}
		{!! Helper::selectList(array("colspan"=>4,"label"=>"Def. Role","name"=>"role","options"=>$getRole,"key"=>"id","val"=>"name","value"=>old('role')))!!}
		{!! Helper::selectStatus(array("colspan"=>4,"label"=>"Status","name"=>"status","value"=>old('status'))) !!}
   </div>
   <div class="row">
   	<div class="col-md-12">
   		<input type="checkbox" name="is_admin" id="is_admin" value="1"/><label>Is QA Admin?</label>
   	</div>
   </div>
   <div id="divAdmin" style="display:none;">
 
  <legend>Permissions</legend>
    <button type="button" id="btnSelAll" class="btn btn-primary">Select All Permissions</button>
    <button type="button" id="btnUnSelAll" class="btn btn-primary">Unselect All Permissions</button><br>
	@foreach($lstOpts as $row)
		@if($row['parent'] == "MAIN")   
			<div class="row">
				<div class="col-md-12">
					<strong>{{$row->name}}</strong>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
				@foreach($lstOpts as $crow)
					@if($crow->parent == $row->optid)
						<input type="checkbox" class="chkperms" name="opts[]" value="{{$crow->optid}}"> {{$crow->name}} &nbsp;
					@endif
				@endforeach
				</div>
			</div>
		@endif
	@endforeach
</div>

  {!! Helper::close("form")!!}
  {!! Helper::closePage() !!}
@endsection

@section('myscript')
<script>
	$("#btnSelAll").on('click',function(){
		$('.chkperms').prop('checked', true);
	});
	$("#btnUnSelAll").on('click',function(){
		$('.chkperms').prop('checked', false);
	});
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
</script>
@endsection

