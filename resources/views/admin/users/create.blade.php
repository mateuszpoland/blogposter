@extends('layouts.app')

@section('content')
		
	<div class="content">
		<div class="panel panel-info">
			<div class="panel-heading text-center">Dodaj użytkownika</div>

			<div class="panel-body">
				<form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
				
					{{ csrf_field() }}
					<div class="form-group col-sm-6" style="margin-top: 20px;">
			
							<label for="title">Nazwa użytkownika</label>
								<input type="text" name="name" class="form-control" required="true" onfocus="clear_msg()">
								@if(!null == Session::get('fail.name'))
								<span class="error" style="color: red">{{ Session::get('fail.name') }}</span>
								@endif
					</div>

					<div class="form-group col-sm-6" style="margin-top: 20px;">
			
							<label for="title">email</label>
								<input type="email" name="email" class="form-control" required="true" onfocus="clear_msg()">
								@if(!null == Session::get('fail.email'))
								<span class="error" style="color: red">{{ Session::get('fail.email') }}</span>
								@endif
						
					</div>
				
						<div class="form-group">
							<input type="submit" id="send" class="btn btn-info" value="submit" />
						</div>
						
				</form>
				
			</div>
		</div>
	</div>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$('input[id=send]').on('click', ()=>{
				$('form').submit();
			});
		});

		function clear_msg(){
			
			$('form').find("span").each(function(){
				$(this).css('display', 'none');
			});
		}
		
	</script>
@stop