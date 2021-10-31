@extends('layouts/contentLayoutMaster')
@section('title', 'Vaccination')
@section('content')
{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>""))!!}
  <!-- {!! Helper::form(array("name"=>"frm","action"=>"{{ route('vaccination.store') }}","ENCTYPE"=>"multipart/form-data","validate"=>"Yes"))!!}
  {!! Helper::hidden(array("name"=>"action","value"=>"Update"))!!} -->

  
  
  <form method="post" action="{{ route('vaccination.store') }}" ENCTYPE="multipart/form-data">
          <div class="form-group">
          {{ csrf_field() }}
          {!!Helper::textbox(array("colspan"=>12,"label"=>"Name","name"=>"name","class"=>"validate['required']","typ"=>"text"))!!}
          </div>
            {!!Helper::textbox(array("colspan"=>12,"label"=>"Details","name"=>"details","class"=>"validate['required']","typ"=>"textarea"))!!}
            {!!Helper::textbox(array("colspan"=>12,"label"=>"Consent Form","name"=>"consent_form","class"=>"validate['required']","typ"=>"number"))!!}
            {!!Helper::textbox(array("colspan"=>12,"label"=>"Consent Details","name"=>"consent_details","class"=>"validate['required']","typ"=>"textarea"))!!}
            {!!Helper::textbox(array("colspan"=>12,"label"=>"Price","name"=>"price","class"=>"validate['required']","typ"=>"number"))!!}
            {!!Helper::textbox(array("colspan"=>12,"label"=>"Discounted Price","name"=>"discounted_price","class"=>"validate['required']","typ"=>"number"))!!}
            {!!Helper::textbox(array("colspan"=>12,"label"=>"Dosages","name"=>"dosages","class"=>"validate['required']","typ"=>"number"))!!}
            {!!Helper::textbox(array("colspan"=>12,"label"=>"Home Collection","name"=>"home_collection","class"=>"validate['required']","typ"=>"number"))!!}
            {!!Helper::textbox(array("colspan"=>12,"label"=>"Image","name"=>"img","class"=>"validate['required']","typ"=>"file"))!!}
            {!!Helper::textbox(array("colspan"=>12,"label"=>"Code","name"=>"code","class"=>"validate['required']","typ"=>"text"))!!}
            <div class="form-group">
              <label for="details">Select Status</label>
                <select class="form-control" name="status">
                    <option value="">Approve</option>
                    <option value="">Suspend</option>
                </select>
            </div>
            {!! Helper::button(array("colspan"=>12,"name"=>"btnUpdate","label"=>"Create","type"=>"submit")) !!}
            </form>

          <!-- <div class="form-group">
              <label for="details">Details</label>
              <input type="textarea" class="form-control" name="details"/>
          </div>
          <div class="form-group">
              <label for="consent_form">Consent Form</label>
              <input type="number" class="form-control" name="consent_form"/>
          </div>
          <div class="form-group">
              <label for="consent_details">Consent Details</label>
              <input type="textarea" class="form-control" name="consent_details"/>
          </div>
          <div class="form-group">
              <label for="price">Price</label>
              <input type="number" class="form-control" name="price">
          </div>
          <div class="form-group">
              <label for="discounted_price">Discounted Price</label>
              <input type="number" class="form-control" name="discounted_price"/>
          </div>
          <div class="form-group">
				<label for="dosages">Dosages</label>
				<input type="number" class="form-control" name="dosages">
            </div>
            <div class="form-group">
				<label for="home_collection">Home Collection</label>
				<input type="number" class="form-control" name="home_collection">
            </div> -->
            <!-- <div class="form-group">
				<label for="status">Status</label>
				<input type="number" class="form-control" name="status">
            </div> -->
             <!-- <div class="row"> 
    </div>  -->
          <!-- <div class="form-group">
              <label for="img">Images</label>
              <input type="file" class="form-control" name="img"/>
          </div>
          <div class="form-group">
              <label for="code">Code</label>
              <input type="text" class="form-control" name="code"/>
          </div> -->
          <!-- <button type="submit" class="btn btn-block btn-danger">Create</button> -->

  <!-- {!!Helper::textbox(array("colspan"=>12,"label"=>"Name","name"=>"name","class"=>"validate['required']","typ"=>"text"))!!}
  {!!Helper::textbox(array("colspan"=>12,"label"=>"Details","name"=>"details","class"=>"validate['required']","typ"=>"textarea"))!!}
  {!!Helper::textbox(array("colspan"=>12,"label"=>"Consent Form","name"=>"consent_form","class"=>"validate['required']","typ"=>"number"))!!}
  {!!Helper::textbox(array("colspan"=>12,"label"=>"Consent Details","name"=>"consent_details","class"=>"validate['required']","typ"=>"textarea"))!!}
  {!!Helper::textbox(array("colspan"=>12,"label"=>"Price","name"=>"price","class"=>"validate['required']","typ"=>"number"))!!}
  {!!Helper::textbox(array("colspan"=>12,"label"=>"Discounted Price","name"=>"discounted_price","class"=>"validate['required']","typ"=>"number"))!!}
  {!!Helper::textbox(array("colspan"=>12,"label"=>"Dosages","name"=>"dosages","class"=>"validate['required']","typ"=>"number"))!!}
  {!!Helper::textbox(array("colspan"=>12,"label"=>"Home Collection","name"=>"home_collection","class"=>"validate['required']","typ"=>"number"))!!}
  {!!Helper::textbox(array("colspan"=>12,"label"=>"Image","name"=>"img","class"=>"validate['required']","typ"=>"file"))!!}
  {!!Helper::textbox(array("colspan"=>12,"label"=>"Code","name"=>"code","class"=>"validate['required']","typ"=>"text"))!!}
  
  {!! Helper::button(array("colspan"=>12,"name"=>"btnUpdate","label"=>"Create","type"=>"submit")) !!} -->
  </form>
  {!! Helper::close("form")!!}
  {!! Helper::closePage() !!}
@endsection

@section('myscript')
<script>
   $("#btnUpdate").on('click',function()
  {
    $("#frm").submit();
  });
  
// $(document).ready(
// function () {
// $('input[type="text"],textarea').bind('change', function () {
// // $('textarea[id$=txtfpconfirmcomments]').change(function (event) {
// alert(this.id);
// if (this.value.match(/[^a-zA-Z0-9 ]/g)) {
// this.value = this.value.replace(/[^a-zA-Z0-9 ]/g, '');
// }
// });
// });
</script>
@endsection