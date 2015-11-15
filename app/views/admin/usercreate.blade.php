@extends('admin.index')
@section('script')
@stop
@section('title')
{{$title}}
@stop

@section('content')
<style type="text/css">
	.titulo{
		text-align: center;
		font-family: 'Montserrat', 'cursive';
	}
	.formulario{
		margin-top: 20px;
	}
	label{
		text-align: center;
	}

	input[type=submit]{
		margin-top: 5px;
	}

	.form{
		margin-top: 30px;
	}

	.bad{
		background-color: rgba(222, 135, 135, 0.86);
	}
</style>

<script type="text/javascript">
	function deleteClass()
	{
		$('#username').removeClass('bad');
	}
</script>
	
	<div class="titulo col-md-12">
		<h2 class="no-float center-block">{{$title}}</h2>
	</div>

	<!--
		<div class="col-md-10 no-float center-block">

			<div class="col-md-8 no-float center-block form">
			{{Form::open(array('url' => 'admin/users/store', 'method' => 'post'))}}
			<label>Nombre</label>
				<div class="col-md-8 no-float">
					<input type="text" class="form-control" name="name" placeholder="Tu nombre" autofocus autocomplete="off" value="{{Input::old('name')}}" >
					<p style="color:red">{{ $errors->first('name') }}</p>
			<label>Apellidos</label>
				<div class="col-md-8 no-float">
					<input type="text" class="form-control" name="apellido" placeholder="Tus apellidos" autofocus autocomplete="off" value="{{Input::old('apellido')}}" >
					<p style="color:red">{{ $errors->first('apellido') }}</p>
				</div>
			<label>Email</label>
				<div class="col-md-8 no-float">
					<input type="email" class="form-control" name="email" placeholder="Tu email" autofocus autocomplete="off" value="{{Input::old('email')}}" >
					<p style="color:red">{{ $errors->first('email') }}</p>

				</div>
			<label>Usuario</label>
				<div class="col-md-8 no-float">
					<input type="text" class="form-control {{$errors->first('class')}}" id="username" minlength="5" onclick="deleteClass()" name="username" placeholder="Tu nombre de usuario" autocomplete="off" value="{{Input::old('username')}}">
					<p style="color:red">{{ $errors->first('username') }}</p>
					<p style="color:red">{{ $errors->first('msg') }}</p>
				</div>
			<label>Contraseña</label>
				<div class="col-md-8 no-float">
					<input type="password" class="form-control" name="password" placeholder="Tu contraseña">
					<p style="color:red">{{ $errors->first('password') }}</p>
				</div>
			<label>Imagen</label>
				<div class="col-md-8 no-float">
					<input type="file" name="imagen" class="form-control" id="file">
				</div>
				<p style="color:red" class="warning-image"></p>
				<input type="hidden" name="value-image" class="value-image" value="">
				<div class="img-responsive col-md-2 no-float">
					<img class="img-responsive img-circle uploadimage" src="">
				</div>
				<div class="col-md-2 no-float">
					<input type="submit" class="btn btn-primary" value="Ingresar">
				</div>
		{{Form::close()}}
		</div>
	</div>
	
	-->
	<div class="col-md-10 no-float center-block">
	{{Form::open(array('url' => 'admin/users/store', 'method' => 'post'))}}
		<div class="col-md-5 no-float center-block">
		<label>Nombre</label>
			<input type="text" name="name" class="form-control" minlength="3">
			<p style="color:red;">{{$errors->first('name')}}</p>
		<label>Apellidos</label>
			<input type="text" name="apellido" class="form-control" minlength="3" autocomplete="off">
			<p style="color:red">{{ $errors->first('apellido') }}</p>
		<label>Email</label>
			<input type="email" name="email" class="form-control" minlength="3" autocomplete="off">
			<p style="color:red">{{ $errors->first('email') }}</p>
		<label>Usuario</label>
			<input type="text" name="username" class="form-control" minlength="3" autocomplete="off">
			<p style="color:red">{{ $errors->first('username') }}</p>
		<label>Contraseña</label>
			<input type="password" name="password" class="form-control" minlength="3" autocomplete="off">
			<p style="color:red">{{ $errors->first('password') }}</p>
		<label>Foto de perfil</label>
			<input type="file" name="imagen" class="form-control" id="file">
			<input type="hidden" name="value-image" class="value-image" vaue="">
			<div class="col-md-8 no-float center-block">
				<img class="img-responsive img-circle uploadimage" src="">
				<p style="color:red" class="warning-image"></p>
			</div>
			<input type="submit" class="btn btn-primary pull-right" value="Guardar cambios">
		</div>
	{{Form::close()}}
	</div>

	<script type="text/javascript">
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
        		 	//console.log('Hay error al subir el archivo');
        		 }
        	});
        	} else {
        		$('.warning-image').html('<p text-align="justified">El formato de archivo que intentas subir no esta permitido.\nIntenta con archivos jpg, jpeg, png, o gif<p>');
        	}


  		});
	</script>
@stop
	