@extends('layouts.app')

@section('content')

	<!-- select z uzytkownikami -->
@if($users->count() > 0)
	<div class="form-group" id="userselect">
		<label for="userselect">Wybierz użytkownika</label>
		<select class="form-control" id="userselect">
			@foreach($users as $user)
				<option value="{{ $user->id }}">{{ $user->name }}</option>
			@endforeach
		</select>
	</div>
	
	<!-- pokaz detale konkretnego uzytkownika - w oddzielnym roucie -->
	
	<!-- checkbox pokaz wszystkich - pojawia sie panel ze wszystkimi uzytkownikami -->
	<a  class="btn btn-sm btn-info" href="" onclick="show_panel(); return false;">Pokaż wszystkich</a>
	<a  class="btn btn-sm btn-success" href="{{ route('users.create') }}">Dodaj użytkownika</a>

	<div style="display: block; margin-top: 20px;" class="panel" id="all_users">
		

		<table class="table">
			<thead class="thead-dark">
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Avatar</th>
					<th scope="col">Nazwa</th>
					<th scope="col">e-mail</th>
					<th scope="col">Pozwolenia</th>
					<th scope="col">Akcje</th>
				</tr>
			</thead>
			@foreach($users as $user)
			<tbody>

				<tr>
					<td>{{ $user->id }}</td>

					<td>
						<!-- wstawiam obrazek z serwera -->
						<img src="{{ asset($user->profile->avatar) }}" alt="" width="30px;" height="30px;" style="border-radius: 50%;">
					</td>

					<td>{{ $user->name }}</td>

					<td>{{ $user->email }}</td>

					<td>@if($user->admin == 1)<span style="color: red;">Admin</span>@else <span style="color: green;">Użytkownik</span>@endif
					</td>

					<td>
						@if( Auth::user()->admin == 1 )
						<button class="btn btn-xs btn-warning" style="color: white; font-weight: 600;" onclick="edit_privileges({{ $user->id }}, event); return false;">Uprawnienia
						</button>

	
						<a href="#">Edytuj</a>
						<a href="#">Usuń</a>

						<!-- edycja uprawnien -->
						<div class="section-edit-privileges" id="edit_privileges_{{ $user->id }}" style="display: none; border-radius: 5px; background-color: lightgray; float: left;">
								<form action="{{ route('users.privileges') }}" method="post"> 

									{{ csrf_field() }}

									<input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
									<span style="margin-bottom: 50px;">edytuj uprawnienia</span><br><br>
									<label for="admin">admin</label>
									<input type="checkbox" name="admin" id="admin">

									<label for="edit">edycja</label>
									<input type="checkbox" name="edit" id="edit">

									<label for="user">uzytkownik</label>
									<input type="checkbox" name="user" id="user">
									<br>

									<input type="button" class="btn-btn-xs btn-info" onclick=" submit_privileges(1, event); return false;" value="zapisz">
								</form>
						</div>
						
						<div class="panel_space"></div>
						@else
						<span style="color: red;">Nie masz uprawnień do edycji.</span>
						@endif
					</td>
				</tr>

			</tbody>
			@endforeach
		</table>
		
	</div>
<!-- ponizej informacje o danym uzytkowniku -->
@else
	<span>Aktualnie brak uzytkownikow</span>
@endif

					

		
<script type="text/javascript">
	$(document).on('change', () =>{
		var selected = $('select').find('option:selected').val();
		console.log(selected);
	});

	function show_panel(){
		$('.panel').toggle();
	}

	function edit_privileges(id, event)
	{	
		var target = event.target;
		var panel = $('#edit_privileges_' + id).toggle('slow');
		panel.addClass('active');
	}
	//dodaj panel edycji do formularza
	/*
	function edit_privileges(id, event){
		
		var target = event.target;
		var panel = $('#def_edit_privileges').clone().attr('id', 'edit_privileges_' + id);
		$(target).parent().append(panel);
	}
	*/

	function submit_privileges(type, event){

		event.preventDefault();
		var target = event.target;
		form = $(target).parent();
	
		
		switch (type)
		{
			//zapisz pojedynczo
			case 1:
			form.submit();
			break;

			//zapisz wszystkie 
			case 2:
			var user_id = [];
			var admin = [];
			var edit = [];
			var user = [];
			var data = [];
			var forms = $("section[id^='edit_privileges']").each(() => {

				var form = $(this).find('form');
				var u_id = form.find('input#user_id').value;
				var adm = form.find('input#admin').value;
				var ed = form.find('input#edit').value;
				var us = form.find('input#user').value;

				
				var formData = new FormData(form);
				data.push(formData);
				user_id.push(u_id);
				admin.push(adm) = adm;
				edit.push(ed);
				user.push(us);
					
			});

			$.post(
					"{{ route('users.privileges') }}", 
 					{ 
 						_token : $('meta[name=csrf-token]').attr('content'),
 						data: data,
 						user_id : user_id,
 						admin : admin,
 						edit : 3,
 						user : 4,
 					}
				)
			.done((response) => {
				console.log(response);
			})
			.fail((response) => {
				console.log('fail');
			});
			break;
		}
		
	}
</script>
@endsection

