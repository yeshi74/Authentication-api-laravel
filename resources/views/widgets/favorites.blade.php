<ul class="nav navbar-nav bookmark-icons">
	<?php $isFound=0; ?>
	@foreach($lstFavorites as $f)
		<?php if($f->optid == $pageid) $isFound=1; ?>
    	<li class="nav-item d-none d-lg-block">
    		<a class="nav-link" href="{{url('admin/'.$f->url)}}" data-toggle="tooltip" data-placement="top" title="{{$f->name}}">
    			<i class="fa fa-lg {{$f->icon}}"></i>
    		</a>
    	</li>
    @endforeach
    <li class="nav-item d-none d-lg-block">
    @if($isFound==0)
    	<a id="addfavorites" class="nav-link" data-id="{{$pageid}}" data-toggle="tooltip" data-placement="top" title="Add to Favorite"><i class="fa fa-lg fa-star-o warning"></i></a>
    @else
    	<a id="delfavorites" class="nav-link" data-id="{{$pageid}}" data-toggle="tooltip" data-placement="top" title="Remove as Favorite"><i class="fa fa-lg fa-star warning"></i></a>
    @endif
    </li>
</ul>