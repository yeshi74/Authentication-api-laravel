<?php
    use App\Helpers\ApolloHelpers;
    $roleURL = url("/admin/roles/view/".$results['role']);
    $roleURL = "<a href='$roleURL'>".$results['rolename']."</a>";
?>
@extends('layouts/contentLayoutMaster')
@section('title', 'Admin Users')
@section('content')
{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>"")) !!}
{!! Helper::form(array("name"=>"frm","action"=>"admin/adminusers/edit","validate"=>"Yes"))!!}
{!! Helper::hidden(array("name"=>"action","value"=>"edit")) !!}
{!! Helper::hidden(array("name"=>"id","value"=>$id))!!}
<div class="row">
	<div class="col-md-12">
	{!! Helper::linkButton(array("url"=>url('admin/adminusers/edit/'.$id),"btnEdit","label"=>"Edit","type"=>"submit","class"=>"btn btn-primary","data"=>array("action"=>"edit")))!!}
	{!! Helper::linkButton(array("url"=>url('admin/adminusers/refresh/'.$id),"btnEdit","label"=>"Refresh Details","type"=>"submit","class"=>"btn btn-warning","data"=>array("action"=>"edit")))!!}
</div>
</div>
<div class="row">
	<div class="col-md-10">
		<div class="row">
		    {!! Helper::display(array("colspan"=>3,"label"=>"Name","name"=>"name","value"=>$results['name'])) !!}
		    {!! Helper::display(array("colspan"=>3,"label"=>"Email","name"=>"email","value"=>$results['email'])) !!}
			{!! Helper::display(array("colspan"=>3,"label"=>"Type","name"=>"is_admin","value"=>$results->usertypename))!!}
			{!! Helper::display(array("colspan"=>3,"label"=>"Gender","name"=>"gender","value"=>$results['gender'])) !!}
		</div>
		<div class="row">
			<?php  $status = ($results['status'] == 0 ? "Active" : "Suspend"); ?>
			{!! Helper::display(array("colspan"=>3,"label"=>"Employee Code","name"=>"emp_code","value"=>$results['emp_code'])) !!}
			{!! Helper::display(array("colspan"=>3,"label"=>"Mobile","name"=>"mobile","value"=>$results['mobile'])) !!}
			{!! Helper::display(array("colspan"=>6,"label"=>"Def. Location","name"=>"location","value"=>$results['locname'])) !!}
		</div>
		<div class="class row">
			{!! Helper::display(array("colspan"=>3,"label"=>"Def. Role","name"=>"role","value"=>$roleURL)) !!}
		    {!! Helper::display(array("colspan"=>6,"label"=>"Department","name"=>"role","value"=>$results['deptname'])) !!}
			{!! Helper::display(array("colspan"=>3,"label"=>"Status","name"=>"status","value"=>$status)) !!}
		</div>	
	</div>
	<div class="col-md-2">
		@if($results['profile']!="")
			<img src="{{$results['profile']}}" class="img-fluid"/>
		@endif
	</div>
</div>
{!! Helper::display(array("colspan"=>12,"label"=>"Is HOD","value"=>$results['is_hod']==1 ? "Yes" : "No"))!!}
<div class="accordion" id="accView">
  	@if($results['is_admin'] == 1)
  		{!! Helper::accordion(array("id"=>"c0","parent"=>"accView","label"=>"Admin Privileges"))!!}
		<div class="row">
		    <div class="col-md-12">
		      	@if($UserPermCount == "0")
					<p>No Permissions is Given</p>
				@else
					@foreach($lstOpts as $row)
						@if($row['parent'] == "MAIN")   
							<?php $ctr=1; ?>
					 		@foreach($lstOpts as $crow)
					 			@if($crow->parent == $row->optid)
					 				<?php $checked=""; ?>
					 				@foreach($lstUserOpts as $o)
					 						@if($o['optid'] == $crow->optid)
					 						@if($ctr==1)
					 				<div class="row">
										<div class="col-md-12">
					 						<strong>{{$row->name}}</strong><br>
					 				@endif
					 				<?php $ctr++; ?>
					 							<i class="fa fa-check"></i>&nbsp; {{$crow->name}} 
					 						@endif
					 					@endforeach
					 			@endif
					 		@endforeach
					 		@if($ctr != 1)
					 			</div>
					 		</div>
					 		@endif
						 @endif
					@endforeach
				@endif
			</div>
		</div>
		{!! Helper::closeAccordion() !!}
	@endif
	{!! Helper::accordion(array("id"=>"c1","parent"=>"accView","label"=>"Additional Locations & Roles"))!!}
  	<div class="row">
    	<div class="col-md-12">
      		<?php echo ApolloHelpers::locationTree(array("name"=>"locations","mode"=>"VIEW","selLocations"=>$lstLocations,"selRoles"=>$lstRoles)); ?>
    	</div>
  	</div>
  	{!! Helper::closeAccordion() !!}
  	@if($results['is_hod']==1)
	  	{!! Helper::accordion(array("id"=>"c2","parent"=>"accView","label"=>"HOD Privileges"))!!}
	    <div class="row">
	      	<div class="col-md-10">
	        	<select name="hod_dept" id="hod_dept" class="form-control">
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
	        </div>
	    </div>
	  	{!! Helper::closeAccordion() !!}
	@endif
	</div>	 
</div>
 

{!! Helper::closePage() !!}
{!! Helper::close("form")!!}
<!-- // Basic Floating Label Form section end -->
@endsection

@section('myscript')
<script>
$("#btnHODFilter").on('click',function(){
    var dept = $("#hod_dept").val();
    if(dept != ""){
      var uURL = "{{url('admin/adminusers/hodlocations/')}}";
      uURL = uURL + '/<?php echo $id ?>/' + dept + "/view";
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
 var url = "{{url('admin/adminusers/')}}";
$(".btnAction").on('click',function(){
    var action = $(this).data("action");
    $("#action").val(action);
     if(confirm("Are you sure you want to perform this action?"))
   {
    var pURL = url + "/" + action;
    $('#frm').attr('action', pURL).submit();
  }
  });
</script>
@endsection