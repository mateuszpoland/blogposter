@extends('layouts.app')


@section('content')
	<!-- wyswietl liste wszystkich kategorii -->
	<div class="panel panel-default">

		<div class="panel-head">
			<h3 class="text-center">Tagi</h3>
		</div>

		<div class="panel-body">
			<table class="table table-hover">
				<thead>
					<th>
						<div class="row">
							<label class="col-sm-3">Dodaj tag</label>

							<a class="btn btn-sm btn-success" href="#add_tag" onclick="add_tag();">+</a>

							<div class="col-sm-1"></div>

							<div class="form-group" id="add_tag" style="display: none;">
								<form action="{{ route('tags.store') }}" method="post" id="tag">
									{{ csrf_field() }}
									<input type="text" name="new_tag" id="tag_add" class="form-control" placeholder="...">	
									
								</form>
							</div>

						</div>
					</th>
				</thead>
			<tbody>
				<tr>
					@if($tags->count() > 0)
					<td>
						@foreach($tags as $tag)
						<div>
						<ul class="tag success">
							<li class="tag-elem">
								<!--<a href=" {{ route('tags.edit', ['id' => $tag->id ]) }}">{{ $tag->tag }}</a> -->
								<a href="" data-toggle="modal" data-target="editmodal">{{ $tag->tag }}</a>
								
							</li>
							<li class="tag-elem">
								<a class="tag-delete" href="{{ route('tags.delete', ['id' => $tag->id ]) }}">X</a>
							</li>
						</ul>

						</div>
						@endforeach
				</td>
				@else
				<td>
					<span class="text-center">Brak tagów</span>
				</td>
				@endif
				</tr>
			</tbody>

		</table>
		</div>	
	</div>

	<!-- modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">

      		<div class="modal-header">
	        	<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          	<span aria-hidden="true">&times;</span>
	        	</button>
      		</div>

     		<div class="modal-body">
        
      		</div>

      		<div class="modal-footer">
	        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        	<button type="button" class="btn btn-primary">Save changes</button>
	      	</div>
    	</div>
  	</div>
</div>
	
	<script type="text/javascript">
		$(document).ready(() =>{
			$(input#tag_add).on('keypress', (e) => {
				if(e.which == 10 || e.which == 13){
					e.preventDefault();
					if($(e.target).val() != ''){
						$('form#tag').submit();
					}
					
				}
			}); 
		});
		function add_tag(){
			$('div#add_tag').toggle('slow');
		}
	</script>

@stop