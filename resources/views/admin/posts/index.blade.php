@extends('layouts.app')


@section('content')
	<!-- wyswietl liste wszystkich kategorii -->
	<div class="panel panel-default">
		<div class="panel-head">
			<h3 class="text-center">Posty</h3>
		</div>
		<div class="panel-body">
			<table class="table table-hover">

			<thead>
					<th>Obrazek</th>
					<th>Tytuł</th>
					<th>Kosz</th>
					<th>Edytuj</th>
			</thead>

			<tbody>
				@if($posts->count() > 0)
					@foreach($posts as $post)
						<tr>
							<td>
								<img src="{{ $post->featured }}" alt="{{ $post->title }}" width="100px" height="50px">
							</td>

							<td>{{ $post->tytul }}
								<div style="font-size: 0.75rem;">Tagi:</div>
								@foreach($post->tags as $tag)
									<span class="tag-info" style="color:gray; font-size: 0.8rem; float: left; padding: 0 5px 0 5px;">
										{{ $tag->tag }}
									</span>
								@endforeach
							</td>

							<td>
								<a class="btn btn-lg btn-warning" href="{{ route('posts.delete', ['id' => $post->id]) }}"><span style="color: white; font-weight: 800;">x</span></a>
							</td>

							<td>
								<a class="btn btn-lg btn-info" href="{{ route('posts.edit', ['id' => $post->id]) }}"><span style="color: white; font-weight: 800;">E</span></a>
							</td>
						</tr>
					@endforeach
				@else
					<tr>
						<th colspan ="5" class="text-center">Brak postów.</th>
					</tr>
				@endif
			</tbody>

		</table>
		</div>	
	</div>
	

@stop