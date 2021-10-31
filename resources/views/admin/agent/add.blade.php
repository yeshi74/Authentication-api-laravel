@extends('layouts/contentLayoutMaster')
@section('title', 'Agents')
@section('content')
{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"FORM","caption"=>""))!!}

  
  
  <form method="post" action="{{ route('agent.save') }}" ENCTYPE="multipart/form-data">
          {{ csrf_field() }}
            {!!Helper::textbox(array("colspan"=>12,"label"=>"Name","name"=>"name","class"=>"validate['required']","typ"=>"text"))!!}
            {!!Helper::textbox(array("colspan"=>12,"label"=>"Email","name"=>"email","class"=>"validate['required']","typ"=>"text"))!!}
            {!!Helper::textbox(array("colspan"=>12,"label"=>"City","name"=>"city","class"=>"validate['required']","typ"=>"text"))!!}
            {!!Helper::textbox(array("colspan"=>12,"label"=>"State","name"=>"state","class"=>"validate['required']","typ"=>"text"))!!}
            {!!Helper::textbox(array("colspan"=>12,"label"=>"Password","name"=>"password","class"=>"validate['required']","typ"=>"password"))!!}
            <div class="form-group">
                <label for="details">Select Status</label>
                  <select class="form-control" name="status">
                      <option>0</option>
                      <option>10</option>
                  </select>
              </div>
              <div class="form-group">
                <label for="details">Pincodes</label>
                  <select class="form-control" name="pincodes[]" multiple>
                      @foreach ($agent as $row)
                      <option>
                          {{ $row->pincode }}
                        </option>
                      @endforeach
                  </select>
              </div>

            {!! Helper::button(array("colspan"=>12,"name"=>"btnUpdate","label"=>"Create","type"=>"submit")) !!}
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