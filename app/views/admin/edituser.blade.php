@extends('admin.index')
@section('title')
	{{$title}}
@stop

@section('script')
@stop

@section('content')
<style type="text/css">
	.no-float{
		float: none;
	}
	.titulo{
		text-align: center;
		font-family: 'Montserrat', 'cursive';
	}

	.form{
		margin-top: 50px;
	}

	input[type=text]{
		width: 100%;
	}
</style>
	</style>
	<div class="col-md-10 no-float center-block text-center">
		<h2>Editar Usuario</h2>
	</div>

	<div class="col-md-10 no-float center-block">
	{{ Form::model($usuario, array('route' => array('user.update', $usuario->uid), 'method' => 'put')) }}
		<div class="col-md-5 no-float center-block">
		<label>Nombre</label>
			<input type="text" name="name" value="{{$usuario->name}}" class="form-control" minleght="3">
			<p style="color:red;">{{$errors->first('name')}}</p>
		<label>Apellidos</label>
			<input type="text" name="apellido" class="form-control" value="{{$usuario->apellido}}" autocomplete="off">
			<p style="color:red">{{ $errors->first('apellido') }}</p>
		<label>Email</label>
			<input type="email" name="email" class="form-control" value="{{$usuario->email}}" autocomplete="off">
			<p style="color:red">{{ $errors->first('email') }}</p>
		<label>Usuario</label>
			<input type="text" name="username" class="form-control" value="{{$usuario->username}}" autocomplete="off">
			<p style="color:red">{{ $errors->first('username') }}</p>
		<label>Contraseña</label>
			<input type="password" name="old-password" class="form-control" id="password" autocomplete="off"><span onclick="view();" id="view" class="glyphicon glyphicon-eye-close"></span>
			<p style="color:red">{{ $errors->first('old-password') }}</p>
			<p style="color:red">{{ $errors->first('msg') }}</p>
		<label>Contraseña nueva</label>
			<input type="password" name="password" class="form-control" autocomplete="off">
			<p style="color:red">{{ $errors->first('password') }}</p>
		<label>Foto de perfil</label>
			<input type="file" name="imagen" class="form-control" id="file">
			<input type="hidden" name="value-image" class="value-image" value="{{$usuario->avatar_uid}}">
			<div class="col-md-8 no-float center-block">
				<img class="img-responsive img-circle uploadimage" src="{{URL::asset('recursos/'.$usuario->avatar->url)}}">
				<p style="color:red" class="warning-image"></p>
			</div>
			<input type="submit" class="btn btn-primary pull-right" value="Guardar cambios">
		</div>
	{{Form::close()}}
	</div>

	<script type="text/javascript">
		function view(){
				var vista = $('#password').attr('type');
				if(vista == 'password'){
					$('#password').attr('type', 'text');
				}else {
					$('#password').attr('type', 'password');
				}
				//console.log(vista);
		}

	   $('#file').change(function()
    	{
        	//obtenemos un array con los datos del archivo
        	var file = $("#file")[0].files[0];
        	//obtenemos el nombre del archivo
        	var fileName = file.name;
        	//obtenemos el tamaño del archivo
        	var fileSize = file.size;
        	//obtenemos el tipo de archivo image/png ejemplo
        	var fileType = file.type;
        	//mensaje con la información del archivo
        	//console.log(fileName + ', ' + file);
        	//obtenemos la extensión del archivo para ejecutar la validación
        	var fileExtension = fileName.substr(fileName.lastIndexOf('.')+1);
        	console.log(fileExtension);

        	if (fileExtension == 'jpg' || fileExtension == 'png' || fileExtension == 'jpeg' || fileExtension == 'gif'){

        		var formData = new FormData();
        		formData.append('imagen', file);

        		$.ajax({
        		url:"{{route('user.upload')}}",
        		type: 'POST',
        		data: formData,
        		cache: false,
        		contentType: false,
        		processData: false,

        		beforeSend: function(){
        			$('.submit').attr('value', 'Subiendo imagen');
        			console.log('Subiendo Imagen');
        		},

        		 success: function(data) {

        		 	$('.submit').attr('value', 'Subir Imagen');
        		 	console.log(data.url + ', ' + data.description);

        		 	if (typeof(data.url) === 'undefined') {
        		 		$('.warning-image').html(data.description);
        		 	} else {
        		 	$('.uploadimage').attr('src', data.url);
        		 	$('.value-image').attr('value', data.id);
        		 	$('.warning-image').html('');
        		 	}
        		 },

        		 error: function(data){
        		 	$('.submit').attr('value', 'Error al subir la imagen');
        		 	console.log('Hay error al subir el archivo');
        		 }
        	});
        	} else {
        		$('.warning-image').html('El formato de archivo que intentas subir no esta permitido\nIntenta con archivos jpg, jpeg, png, o gif');
        	}


  		});
	</script>


@stop