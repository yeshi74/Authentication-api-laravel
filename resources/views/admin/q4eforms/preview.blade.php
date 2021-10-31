<html>
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600">
    <link rel="stylesheet" href="{{ asset('public/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/vendors/css/ui/prism.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap-extended.css') }}">
        <link rel="stylesheet" href="{{ asset('public/css/colors.css') }}">
        <link rel="stylesheet" href="{{ asset('public/css/components.css') }}">
        <link rel="stylesheet" href="{{ asset('public/css/themes/dark-layout.css') }}">
        <link rel="stylesheet" href="{{ asset('public/css/themes/semi-dark-layout.css') }}">
        <link rel="stylesheet" href="{{ asset('public/css/validationEngine.jquery.css')}}">
        <link rel="stylesheet" href="{{ asset('public/vendors/css/forms/select/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/vendors/css/pickers/pickadate/pickadate.css') }}">
        <link rel="stylesheet" href="{{ asset('public/vendors/css/tables/datatable/datatables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/vendors/summernote/summernote-lite.css') }}">
    <link rel="stylesheet" href="{{ asset('public/vendors/hummingbird/hummingbird-treeview.css') }}">
        <link rel="stylesheet" href="{{ asset('public/vendors/colorbox/colorbox.css') }}">
</head>
<body>
    <h3>{{$results['name']}}</h3>
    <p>{!! $results['header'] !!}</p>
    {!! Helper::form(array("name"=>"frm","action"=>"admin/q4eforms/results/save-complete","validate"=>"Yes")) !!}
    {!! Helper::hidden(array("name"=>"form_id","value"=>$id))!!}
    {!! Helper::hidden(array("name"=>"id","value"=>$assignID))!!}
    @foreach($lstSections as $row)
        @if($row['display']==0)
            <h4>{{$row['name']}}</h4>
            @if($row['style'] == "1 Column")
                @foreach($row['lstItems'] as $srow)
                    @if($srow['status'] == 0)
                        <label>{{$srow['name']}}</label><br>
                        <textarea style="width:100%" class="form-control" name="f{{$srow['id']}}"></textarea>
                    @endif
                @endforeach
            @else
                <table class="table table-stripped" width="100%">

                    <tr>
                        <th>Sr#</th>
                        <th>{{$row['header1']}}</th>
                        @if($row['style'] == "3 Columns")
                            <th>{{$row['header2']}}</th>
                        @endif
                        <th>{{$row['results_header']}}</th>
                        <th>{{$row['remarks_header']}}</th>
                    </tr>
                    <?php $ctr=1; ?>
                    @foreach($row['lstItems'] as $srow)
                        @if($srow['status'] == 0)
                            <tr>
                                @if($srow['typ']=="SELECT")
                                    <td>{{$ctr}}</td>
                                    <td>{{$srow['name']}}</td>
                                    @if($row['style'] == "3 Columns")
                                        <td>{{$srow['header']}}</td>
                                    @endif
                                    <td>
                                    @php
                                        $opts = explode(";",$srow['answerOptions']);
                                    @endphp
                                        <select name="f{{$srow['id']}}" class="form-control">
                                            @foreach($opts as $opt) 
                                                    <option value="{{$opt}}">{{$opt}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="text" name="r{{$srow['id']}}" class="form-control"></td>
                                    <?php $ctr++; ?>
                                @endif
                                @if($srow['typ']=="LABEL")
                                   <td></td>
                                    @if($row['style'] == "3 Columns")
                                        <td colspan=4>
                                    @endif
                                    @if($row['style'] == "2 Columns")
                                        <td colspan=3>
                                    @endif

                                    <strong>{{$srow['name']}}</strong>
                                    </td>
                                @endif
                                @if($srow['typ']=="TEXT")
                                  <td>{{$ctr}}</td>
                                    <td>{{$srow['name']}}</td>
                                    @if($row['style'] == "3 Columns")
                                        <td>{{$srow['header']}}</td>
                                    @endif
                                    <td>
                                        <input type="text" name="f{{$srow['id']}}" class="form-control">
                                    </td>
                                    <td><input type="text" name="r{{$srow['id']}}" class="form-control"></td>
                                    <?php $ctr++; ?>
                                @endif
                               
                            </tr>
                            
                        @endif
                    @endforeach

                </table>
            @endif
            <p>{{$row['footer']}}</p>
            <hr/>
        @endif
    @endforeach
    {!! Helper::textbox(array("colspan"=>12,"label"=>"Remarks","name"=>"remarks","typ"=>"TEXTAREA"))!!}
    <input type="file" name="attachments">
    <button type="submit">Submit</button>
    {!! Helper::close("form")!!}
    <p>{!! $results['footer'] !!}</p>
</body>
</html>
 