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
					<th>Przywróć</th>
					<th>Zniszcz</th>
			</thead>

			<tbody>
				@if($trashed->count() > 0)
					@foreach($trashed as $post)
						<tr>
							<td>
								<img src="{{ $post->featured }}" alt="{{ $post->title }}" width="100px" height="50px">
							</td>

							<td>{{ $post->tytul }}</td>

							<td>
								<a class="btn btn-lg btn-info" href="{{ route('posts.restore', ['id' => $post->id]) }}"><span style="color: white; font-weight: 800;">Przywróć</span></a>
							</td>

							<td>
								<a class="btn btn-lg btn-danger" href="{{ route('posts.kill', ['id' => $post->id]) }}"><span style="color: white; font-weight: 800;">X</span></a>
							</td>
						</tr>
					@endforeach
				@else
					<tr>
						<th colspan ="5" class="text-center">Kosz jest pusty.</th>
					</tr>
				@endif
			</tbody>
		</table>
		</div>	
	</div>
	

	<script type="text/javascript">
    @if(Session::has('success'))
        toastr.success("{{ Session::get('success') }}"); 
    @endif
	</script>

@stop