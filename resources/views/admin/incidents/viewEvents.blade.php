 <?php
    function isActive($id,$lstEvents)
    {
        $checked="false";
        foreach($lstEvents as $row)
        {
            if($row->event_id == $id) $checked="true";
        }
        return $checked;
    }
    function checkCategory($id,$lstCategory,$lstEvents)
    {
        $cnt=0;
        foreach($lstCategory as $row)
        {
            if($row->id == $id)
            {
                foreach($lstCategory as $srow)
                {
                    if($srow->parent == $id)
                    {
                        if($srow->typ=="ITEM")
                        {
                            $checked = isActive($srow->id,$lstEvents);
                            if($checked=="true") $cnt++;
                        }
                        if($srow->typ=="GROUP")
                        {
                            foreach($lstCategory as $crow)
                            {
                                if($crow->parent == $srow->id)
                                {
                                    $checked = isActive($crow->id,$lstEvents);
                                    if($checked=="true") $cnt++;
                                }
                            }
                        }
                    }
                }
            }
        }
        return $cnt;
    }
?>
<ul style="list-style:none">
            <?php
                foreach($lstCategory as $row)
                {
                    if($row->typ == "CATEGORY")
                    {
                        $cnt= checkCategory($row->id,$lstCategory,$lstEvents);
                        if($cnt > 0){
                        ?><li>{{$row->caption}}<ul><?php 
                        foreach($lstCategory as $srow)
                        {
                            if($srow->parent == $row->id)
                            {
                                if($srow->typ=="ITEM")
                                {
                                    $checked = isActive($srow->id,$lstEvents);
                                    if($checked=="true"){
                                        ?><li style="list-style:none;"><i class="fa fa-check fa-lg"></i>{{$srow->caption}}</li><?php 
                                    }
                                }
                                if($srow->typ=="GROUP")
                                {
                                    $ctr=1;
                                    
                                    foreach($lstCategory as $crow)
                                    {
                                        if($crow->parent == $srow->id){
                                            $checked = isActive($crow->id,$lstEvents);
                                             if($checked=="true")
                                             {
                                                if($ctr == 1){
                                                    ?><li style="list-style:none;">{{$srow->caption}} <ul><?php 
                                                }
                                                $ctr++;
                                                ?><li style="list-style:none;"><i class="fa fa-check fa-lg"></i>{{$crow->caption}} </li><?php 
                                            }  
                                        }
                                    }
                                    if($ctr > 1){
                                    ?></ul></li><?php }
                                }
                                
                            }
                        }
                        ?></ul></li><?php 
                    }
                    }
                }
            ?>
            </ul>