@extends('layouts.app')

@section('content')

@include('admin.partials.errors_display')

<div class="jumbotron">
	<div class="panel panel-default">
		<div class="panel-heading">
			Edytuj kategorię: {{ $category->nazwa }}
		</div>

		<div class="panel-body">
			<form action="{{ route('category.update') }}" method="post">

				{{ csrf_field() }}
				<div class="form_group">
					<input type="hidden" name="id" value="{{ $category->id }}">
					<input type="text" name="name" class="form-control" placeholder="Edytuj nazwę dla: ...{{ $category->nazwa }}">
				</div>

				<div class="form-group" style="margin-top: 10px;">
					<div class="text-center">
						<button type="submit" class="btn btn-success">Popraw</button>
						<a class="btn btn-info" href="{{ route('admin.home') }}">Wróć</a>
					</div>
				</div>
				@include('admin.partials.success_message')
			</form>

		</div>
	</div>
</div>
@stop