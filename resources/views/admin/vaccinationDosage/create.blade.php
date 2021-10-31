@extends('layouts/contentLayoutMaster')
@section('title', 'Vaccination Dosage')
@section('content')
{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>""))!!}

  
  
  <form method="post" action="{{ route('vaccinationDosage.store') }}" ENCTYPE="multipart/form-data">
          <div class="form-group">
          {{ csrf_field() }}
          <div class="form-group">
            @foreach($vaccinations as $row)
              <label for="details">Select Status</label>
                <select class="form-control" name="status">
                    <option value="">{{ $vaccinations->id }}</option>
                    <option value=""></option>
                </select>
                @endforeach
            </div>          
          </div>
            {!!Helper::textbox(array("colspan"=>12,"label"=>"Dosage No","name"=>"dosage_num","class"=>"validate['required']","typ"=>"number"))!!}
            {!!Helper::textbox(array("colspan"=>12,"label"=>"Days after","name"=>"days_after","class"=>"validate['required']","typ"=>"number"))!!}
            {!! Helper::button(array("colspan"=>12,"name"=>"btnUpdate","label"=>"Create","type"=>"submit")) !!}
            </form>

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
</script>
@endsection