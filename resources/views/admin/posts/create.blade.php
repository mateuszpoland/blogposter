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
			Dodaj nowy post
		</div>

		<div class="panel-body">
			<form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data" id="post_add">

				{{ csrf_field() }}
				<div class="form_group">
					<label for="title">Tytuł posta</label>
					<input type="text" name="title" class="form-control">
				</div>

				<div class="form_group">
					<label for="pic">Obrazek</label>
					<input type="file" name="picture" id="pic" class="form-control-file">
				</div>

				<div class="form_group">
					<label for="content">Treść</label>
					<textarea name="content" class="form-control"></textarea>
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
				<label for="tags" style="font-weight: 700;">Tagi</label>
				@foreach($tags as $tag)
				<div class="checkbox">
					<label style="float: left; padding: 10px 5px 0 5px;"><input type="checkbox" name="tags[]" value="{{ $tag->id }}">{{ $tag->tag }}</label>
				</div>
				@endforeach
				<div style="display: block; clear: both;"></div>
				<div class="form_group">
					<a href="#add_cat" onclick="show_cat();">Dodaj nową kategorię</a>
				</div>

				<div class="form-group" style="margin-top: 10px;">
					<div class="text-center">
						<button type="submit" class="btn btn-success">Opublikuj</button>
					</div>
				</div>
			</form>

			<!--sekcja dodawania kategorii widoczna po kliknieciu w link -->
			<section class="form-category" style="display: none;">
					<div class="form_group col-lg-5">
						<label for="name">Nazwa kategorii</label>
						<input type="text" id="cat_name" class="form-control" onblur="append_cat()">
					</div>
			</section>
		</div>
	</div>
	<script type="text/javascript">

		function show_cat(){
			$('section.form-category').toggle('slow');
			$('form').append(
				'<input type="hidden" name="category_added" id="cat_id_hidden" value=""/>'
				);
		}
		
		function append_cat(){
			var input = $('input[id="cat_name"]').val();
			$('input#cat_id_hidden').val(input);
			
		}
	</script>
</div>
@stop


