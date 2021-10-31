@extends('layouts/contentLayoutMaster')
@section('title', 'Locations')
@section('content')
{!! Helper::startPage(array("bc"=>$breadcrumbs,"typ"=>"TABLE","caption"=>""))!!}
  {!!Helper::form(array("name"=>"frm","action"=>"admin/locations/view"))!!}
  {!!Helper::hidden(array("name"=>"action","value"=>"view"))!!}
  {!!Helper::hidden(array("name"=>"id","value"=>""))!!}
    <div class="row">
        {{-- {!!Helper::button(array("colspan"=>4,"name"=>"btnAdd","label"=>"Add  New Location","class"=>"btn-primary btnAdd"))!!} --}}
        {!!Helper::button(array("colspan"=>4,"name"=>"btnAd","label"=>"Add Region","class"=>"btn-primary btnAdd"))!!}
        {!!Helper::button(array("colspan"=>4,"name"=>"btncenter","label"=>"Add Center","class"=>"btn-primary btnAdd"))!!}
    </div>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped dataex-html5-selectors">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Name</th>
                            <th>Parent</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($results as $row):
                            $alink='';
                            $_id=$row['id'];
                            $type=str_limit($row['typ'],100);
                            $url = "<a href='Javascript:void(0)' class='lnkView' data-id='".$row['id']."'>".$type."</a>";
                        ?>
                       <tr>
                            <td>{!! $url !!}</td>
                            <td>{!! $row['name'] !!}</td>
                            <td>{!! $row['parentname'] !!}</td>
                        </tr>
                        <?php
                            endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {!!Helper::close("form")!!}
    {!! Helper::closePage()!!}
</section>
@endsection

@section('myscript')
   <script>
        $("#btnAdd").on('click',function()
        {
            $("#action").val("add");
            $('#frm').attr('action', "{{url('admin/locations/add')}}").submit();
        });
        $("#btnAd").on('click',function()
        {
            $("#action").val("addregion");
            $('#frm').attr('action', "{{url('admin/locations/addregion')}}").submit();
        });

        $("#btncenter").on('click',function()
        {
            $("#action").val("addcenter");
            $('#frm').attr('action', "{{url('admin/locations/addcenter')}}").submit();
        });


        $(".lnkView").on('click',function(){
            $("#id").val($(this).data("id"));

            $("#action").val("view");
            $('#frm').attr('action', "{{url('admin/locations/view')}}").submit();
       });
    </script>
@endsection
