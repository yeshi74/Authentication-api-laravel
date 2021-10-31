<form method="{{$opt['method']}}" 
	  	id="{{$opt['name']}}" 
		name="{{$opt['name']}}"
		action="{{url($opt['action'])}}"
		class="{{$opt['class']}}"
		ENCTYPE="multipart/form-data"
		@if($opt['target'] != "")
			target="{{$opt['target']}}"
		@endif
>
		@if($opt['method'] == "POST")
		 {{ csrf_field() }}
		@endif