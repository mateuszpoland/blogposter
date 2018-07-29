@extends('layouts.app')

@section('content')

@if(count($errors) > 0)
<ul class="list-group">
	@foreach($errors->all() as $error)
	<li class="list-group-item text-danger">{{ $error }}</li>
	@endforeach
</ul>
@endif
<!-- formularz dodawania nowego posta -->
<div class="jumbotron">
	<div class="panel panel-default">
		<div class="panel-heading">
			Edytuj post <strong style="margin-left: 10px;">{{$post->tytul}}</strong>
		</div>

		<div class="panel-body">
			<form action="{{ route('posts.update', ['id' => $post->id]) }}" method="post" enctype="multipart/form-data" id="post_add">

				{{ csrf_field() }}
				<div class="form_group">
					<label for="title">Tytuł posta</label>
					<input type="text" name="title" class="form-control" value="{{ $post->tytul }}">
				</div>

				<div class="form_group">
					<label for="pic">Obrazek</label>
					<input type="file" name="picture" id="pic" class="form-control-file" value="{{ $post->featured }}">
				</div>

				<div class="form_group">
					<label for="content">Treść</label>
					<textarea name="content" class="form-control" value="">{{ $post->tresc }}</textarea> 	
				</div>

				<div class="form_group">
					<label for="katselect">Kategoria</label>
					<select class="form-control" id="category" name="category_id">
						@foreach($categories as $category)
						<option value="{{$category->id}}">{{$category->nazwa}}</option>
						@endforeach
					</select>
				</div>

				<!-- tagi -->
				<div class="form-group">
					<label for="tags" style="font-weight: 700;">Tagi</label>
					@foreach($tags as $tag)
						<div class="checkbox">
							<label style="float: left; padding: 10px 5px 0 5px;">
								<input type="checkbox" name="tags[]" 	value="{{ $tag->id }}" @if(in_array($tag->tag, $post_tags))checked="true"@endif }}>{{ $tag->tag }}</label>
						</div>
					@endforeach
					<div style="display: block; clear: both;"></div>
				</div>

				<div class="form-group" style="margin-top: 10px;">
					<div class="text-center">
						<button type="submit" class="btn btn-success">Opublikuj</button>
					</div>
				</div>
			</form>
</div>
@stop