@if(Session::has('success'))
	<div class="alert alert-success">
		<ul>
			<li> {{ Session::get('success') }} </li>
		</ul>
	</div>
@elseif(Session::has('notify-delete'))
	<div class="alert alert-danger">
		<ul>
			<li>{{ Session::get('notify-delete') }}</li>
		</ul>
	</div>
@endif