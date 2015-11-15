<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@section('title'){{$title}}@show _- The Admin Site -_</title>
	@section('style')
	@show

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
	<link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	@section('script')
	@show
</head>
<body>
<script type="text/javascript">
	$(window).ready(function()
	{
		console.log('Estamos listos');
		var width = $(window).innerWidth();
		console.log(width);

		if (width < 450) {
				$('.el-nave').css('display', 'none');
				$('.navegador').append('<p class="btn-menu" style="font-size: 1.2em;"><span class="glyphicon glyphicon-menu-hamburger"></span></p>');
			} else {
				$('.el-nave').fadeIn();
				$('.navegador').remove('.btn-menu');
			}


		$('.btn-menu').click(function(){
			$('.el-nave').toggle(500);
		});

	});
</script>
<style type="text/css">
	.no-float{
		float: none;
	}
	
	a{
		text-decoration: none;
		font-family: 'Montserrat', 'cursive';
		font-size: 1.5em;
		transition: all .3s;
		color: #087AB3;
	}

	a:hover{
		box-shadow: 0 0 5px rgba(0,0,0,0.31);
		border-radius: .2em;
	}

	.avatar{
		width: 95%;
	}

	.navegador{
		vertical-align: middle;
		margin-top: 40px;
	}

	.el-nave li a{
		color: #087AB3;
		margin-left: 10px;
	}

	.el-nave li{
		list-style: none;
		display: inline-block;
		margin-right: 25px;
		margin-bottom: 15px;
	}

	.glyphicon-menu-down:hover{
		color: black;
		font-size: .5em;
	}
	.glyphicon-menu-down{
		color: black;
		font-size: .5em;
	}

	.glyphicon-remove-circle{
		font-size: .9em;
		color: black;
	}

	.btn-menu{
		cursor: pointer;
	}

	.submenu{
		box-sizing: border-box;
	}

	 li > ul.submenu {
            display: none;
            list-style: none;
            transition: all .5s;
        }

    ul.submenu > li {
            display: block;
        }
	li:hover ul.submenu {
            display: block;
            position: absolute;
            margin-top: 1px;
        }
    .footer{
    	margin-top: 50px;
    }

    .glyphicon-remove-circle{
    	color: white;
    }

@media (max-width: 520px){
	.el-nave li{
		display: block;
		margin-bottom: 5px;
	}
	.el-nave li a{
		margin-left: 0px;
	}
}

</style>

	<nav class="navbar navbar-default">
 		<div class="container-fluid">
    		<div class="navbar-header">
    			<div class="col-md-6 col-xs-6 no-float center-block">
        			<img style="margin-top: 10px;" alt="Brand" class="thumbnail img-responsive img-circle avatar" src="{{URL::asset('recursos/'.Auth::user()->avatar->url)}}">
        		</div>
    		</div>
    			<div class="navegador col-md-10 no-float center-block">
    				<ul class="el-nave">
    					<li><a href="{{route('admin.index')}}"><button class="btn btn-primary"><span class="glyphicon glyphicon-home"></span> Inicio</button></a></li>
    					<li><a href="{{route('laura')}}"><button class="btn btn-primary"><span class="glyphicon glyphicon-tag"></span> Laura</button></a></li>
    					<li><a href=""><button class="btn btn-primary"><span class="glyphicon glyphicon-tag"></span> Jaime</button></a></li>
    					<li><a href=""><button class="btn btn-primary"><span class="glyphicon glyphicon-comment"></span> Mensajes</button></a></li>
    					<li><a href="{{route('admin.user')}}"><button class="btn btn-primary"><span class="glyphicon glyphicon-user"></span> Usuarios</button></a></li>
    					<li><a href="#"><button class="btn btn-primary username"><span class=""></span> {{$username}}</button></a>
    						<ul class="submenu" id="submenu">
    						<li><a href="{{route('logout')}}"><button class="btn btn-primary"><span class="glyphicon glyphicon-remove-circle"></span> Salir</button></a></li>
    						</ul>
    					</li>
    				</ul>
    			</div>
  		</div>
	</nav>
	</style>


	@section('content')
	@show

	<footer style="margin-top:50px;">
		<div class="col-md-5 no-float center-block text-center">
			<p>Todos los derechos reservados &copy {{date('Y')}}</p>
		</div>
	</footer>

</body>
</html>