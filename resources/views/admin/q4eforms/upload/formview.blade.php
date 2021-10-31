<div class="row">
        <div class="col-md-10">
            <h4>{{$results['name']}} <span class="title">({{$results['typname']}})</span></h4>
        </div>
        <div class="col-md-2">
            {{$results['statusName']}}
        </div>
    </div>
    <div class="row">
        {!! Helper::display(array("colspan"=>3,"label"=>"Frequency","value"=>$results['frequency'])) !!}
        {!! Helper::display(array("colspan"=>3,"label"=>"Results Type","value"=>$results['results_typ'])) !!}
        {!! Helper::display(array("colspan"=>3,"label"=>"Days to Submit","value"=>$results['days_submit'])) !!}
        {!! Helper::display(array("colspan"=>3,"label"=>"Owner","value"=>$results['ownername'])) !!}
    </div>
    <div class="row">
        <?php 
            $c="";
            if($results['color'] != ""){
                $c = "fbg-".$results['color'];
            }
        ?>
        <div class="col-md-3">
            <label>Color</label>
            <div class=" {{$c}}">&nbsp;<br/></div>
        </div>
        <?php 
            $icon="";
            if($results['icon'] != ""){
                $icon = "<img src='".$imgPath.$results['icon'].".png' height='100px'/>";
            }
        ?>
        <div class="col-md-3">
            <label>Icon</label><br/>
            {!! $icon !!}
        </div>
        @if($results->typcode=="OUTCOME" || $results->typcode=="CHECKLIST")
            {!! Helper::display(array("colspan"=>3,"label"=>"Max Value for Scoring","value"=>$results['max_val']))!!}
        @endif
    </div>
    <div class="row" style="margin-bottom:10px;">
        <div class="col-md-6">
            <label>Applicable to BU</label><br/>
            @foreach($lstApplicableBU as $row)
                {{$row->name}}&nbsp;
            @endforeach
        </div>
    
    @if($results['frequency'] == "Quarterly")
            <div class="col-md-6">
                <label>Run on Months</label><br/>
                <?php  
                foreach($lstMonths as $m) {
                    echo $m."&nbsp;";
                }?>
            </div>
    @endif
</div>