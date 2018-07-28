@extends('layouts.app')


@section('content')
	<!-- wyswietl liste wszystkich kategorii -->
	<div class="panel panel-default">

		<div class="panel-head">
			<h3 class="text-center">Kategorie</h3>
		</div>

		<div class="panel-body">
			<table class="table table-hover">

			<thead>
				<th>Nazwa kategorii</th>
				<th>Edytuj kategorię</th>
				<th>Usuń kategorię</th>
			</thead>

			<tbody>
				@if($categories->count() > 0)
					@foreach($categories as $category)
						<tr>
							<td>
								{{ $category->nazwa }}
							</td>

							<td>
								<a class="btn btn-xs btn-info" href=" {{ route('category.edit', ['id' => $category->id]) }}">
									E
								</a>
							</td>

							<td>
								<a class="btn btn-xs btn-danger" href=" {{ route('category.delete', ['id' => $category->id]) }}">
									X
								</a>
							</td>

						</tr>
					@endforeach
				@else
					<tr>
						<th colspan ="5" class="text-center">Indeks kategorii jest pusty.</th>
					</tr>
				@endif
			</tbody>

		</table>
		</div>	
	</div>
	

@stop