@extends('layouts.app')

@section('content')

@include('admin.partials.errors_display')

<div class="jumbotron">
	<div class="panel panel-default">
		<div class="panel-heading">
			Dodaj kategorię
		</div>

		<div class="panel-body">
			<form action="{{ route('category.store') }}" method="post">

				{{ csrf_field() }}
				<div class="form_group">
					<label for="name">Nazwa kategorii</label>
					<input type="text" name="name" class="form-control">
				</div>

				<div class="form-group" style="margin-top: 10px;">
					<div class="text-center">
						<button type="submit" class="btn btn-success">Dodaj</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- jeżeli nie ma kategorii, trzeba ją utworzyć -->
	<script type="text/javascript">
	@if(Session::has('info'))
		toastr.info("{{ Session::get('info') }}");
	@endif
</script>
</div>
@stop



