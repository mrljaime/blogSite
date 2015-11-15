<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="witdh=device-width, initial-scale=1">
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
	<link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

@if($contador == true)
<style type="text/css">
	body{
		background-color: lightgrey;
	}

	.no-float{
		float: none;
	}
	.formulario{
	}

	input{
		transition: all .3s;
		font-size: 1.5em;
	}

	input[type=text], input[type=password]{
		font-family: 'Montserrat', 'cursive';
	}

	input[type=submit]{
		margin-top: 10px;
		transition: all .3s;
	}

	input[type=submit]:hover{
		-webkit-box-shadow: 0 0 1px black;
		-oz-box-shadow: 0 0 1px black;
		box-shadow: 0 0 1px black;
	}

	label{
		font-family: 'Poiret One', cursive;
		font-size: 1.5em;
	}

</style>
@else

<style type="text/css">
	body{
		background-color: lightgrey;
	}

	.no-float{
		float: none;
	}
	.formulario{
		display: none;
	}

	input{
		transition: all .3s;
		font-size: 1.5em;
	}

	input[type=text], input[type=password]{
		font-family: 'Montserrat', 'cursive';
	}

	input[type=submit]{
		margin-top: 10px;
		transition: all .3s;
	}

	input[type=submit]:hover{
		-webkit-box-shadow: 0 0 1px black;
		-oz-box-shadow: 0 0 1px black;
		box-shadow: 0 0 1px black;
	}

	label{
		font-family: 'Poiret One', cursive;
		font-size: 1.5em;
	}

</style>
@endif

	<title>Intendificate por fa</title>
</head>
<body>

<script type="text/javascript">
	$(window).ready(function(){

		var altura = $(window).innerHeight();
		console.log(altura);

		var formulario = $('.formulario').innerHeight();
		console.log(formulario);

		$('.formulario').animate({
			'margin-top': (altura/2)-(formulario/2),
			}, 300, function(){
				$('.formulario').css('display', 'block');
			});


	});



</script>


	@if($contador == true)
	<div class="formulario col-md-12 no-float center-block text-center"> 
	@if($errors->any())
		<div class="col-md-4 no-float text-center center-block">
			<p style="color:red">{{$errors->first()}}</p>
		</div>
	@endif
		{{Form::open(array('url' => 'ingresar', 'method' => 'POST'))}}
			<label>Usuario</label>
				<div class="col-md-4 no-float center-block">
					<input type="text" class="form-control" name="username" placeholder="Tu nombre de usuario" required autofocus autocomplete="off" >
				</div>
			<label>Contraseña</label>
				<div class="col-md-4 no-float center-block">
					<input type="password" class="form-control" name="password" placeholder="Tu contraseña">
				</div>
				<div class="col-md-2 no-float center-block">
					<input type="submit" class="btn btn-primary" value="Ingresar">
				</div>

	</div>
	@else
		<div class="formulario col-md-12 no-float center-block text-center"> 
		{{Form::open(array('url' => 'registro', 'method' => 'POST'))}}
			<label>Nombre</label>
				<div class="col-md-4 no-float center-block">
					<input type="text" class="form-control" name="name" placeholder="Tu nombre" required autofocus autocomplete="off" >
				</div>
			<label>Apellidos</label>
				<div class="col-md-4 no-float center-block">
					<input type="text" class="form-control" name="apellido" placeholder="Tus apellidos" required autofocus autocomplete="off" >
				</div>
			<label>Email</label>
				<div class="col-md-4 no-float center-block">
					<input type="email" class="form-control" name="email" placeholder="Tu email" required autofocus autocomplete="off" >
				</div>
			<label>Usuario</label>
				<div class="col-md-4 no-float center-block">
					<input type="text" class="form-control" name="username" placeholder="Tu nombre de usuario" required autocomplete="off" >
				</div>
			<label>Contraseña</label>
				<div class="col-md-4 no-float center-block">
					<input type="password" class="form-control" name="password" placeholder="Tu contraseña">
				</div>
				<div class="col-md-2 no-float center-block">
					<input type="submit" class="btn btn-primary" value="Ingresar">
				</div>
		{{Form::close()}}
	</div>
	@endif

</body>
</html>