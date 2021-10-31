@extends('layouts/contentLayoutMaster')
@section('title', 'Roles')
@section('content')
   
    {!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
    {!!Helper::form(array("name"=>"frm","action"=>"admin/roles/view"))!!}
    {!!Helper::hidden(array("name"=>"action","value"=>"view"))!!}
    {{-- //{!!Helper::button(array("colspan"=>10,"name"=>"btnAdd","label"=>"Add  New Role","class"=>"btn-primary btnAdd"))!!} --}}
    {!! Helper::linkButton(array("colspan"=>12,"url"=>url('admin/roles/add'),"label"=>"Add  New Role","class"=>"btn-primary btnAdd")) !!}
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped dataex-html5-selectors">
                    <thead>
                        <tr><th>Code</th><th>Name</th><th>Default Role</th></tr>
                    </thead>
                        <tbody>
                            @foreach($results as $row)
                            <?php $name=str_limit($row['code'],100);
                                $def = $row['def_role'] == 1 ? "Yes" : "No";
                            ?>
                            <tr>
                                <td><a href='{{url("admin/roles/view/".$row->id)}}'>{{$name}}</a></td>
                                <td>{!! $row['name'] !!}</td>
                                <td>{{$def}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
    {!!Helper::close("form")!!}
    {!! Helper::closePage()!!}
@endsection

{{-- @section('myscript')
   <script>
        $("#btnAdd").on('click',function()
        {
            $("#action").val("add");
            location.href="{{url('admin/roles/add')}}";
            //$('#frm').attr('action', "{{url('admin/roles/add')}}").submit();
        });
    </script>
@endsection --}}
