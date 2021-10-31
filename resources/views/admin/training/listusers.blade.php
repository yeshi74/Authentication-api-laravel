@if(count($results) > 0)
<table class="table table-stripped">
	<tr>
		<th></th>
		<th>User</th>
	</tr>
	@foreach($results as $row)
		<tr>
			<td><input type="checkbox" name="userid[]" value="{{$row->id}}" class="chk"/></td>
			<td>{{$row->name}}</td>
		</tr>
	@endforeach
</table>
@endif