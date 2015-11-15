@extends('admin.index')
@section('title')
	{{$title}}
@stop

@section('script')
@stop

@section('content')
<style type="text/css">
	#users{
		margin-top: 30px;
	}

	.bloque{
		background-color: #F3F3F3;
		padding-bottom: 40px;
		padding-top: 40px;
		box-shadow: 0 0 5px rgba(0,0,0,0.31);
	}
</style>



	<div class="col-md-10 no-float center-block bloque">
		<div style="margin-top: 20px;" class="no-float center-block text-center">
			<h2 style="font-family: 'Montserrat', 'cursive';">Usuarios</h2>
		</div>
		<div style="margin-top: 20px;" class="col-md-10 no-float center-block">
			<a href="{{route('user.create')}}"><button class="btn btn-primary">Crear</button></a>
			<p style="color:#069">{{$errors->first('msg')}}</p>
		</div>

		<div class="col-md-10 no-float center-block users" id="users">
			<table class="table table-striped">
			<thead>
				<tr>
					<th>uid</th>
					<th>username</th>
					<th>nombre</th>
					<th></th>
				</tr>
			</thead>
			@foreach($usuarios as $u)
				<tbody>
					<tr>
						<td>{{$u->uid}}</td>
						<td>{{$u->username}}</td>
						<td>{{$u->name}}</td>
						<td><a href="{{route('user.edit', $u->uid)}}"><span class="glyphicon glyphicon-pencil"></span></a></td>
						<td><a href="{{route('user.delete', $u->uid)}}"><span class="glyphicon glyphicon-trash"></span></a></td>
					</tr>
				</tbody>
			@endforeach
			</table>
		</div>
	</div>


	<!--<div class="titulo col-md-12">
		<h2 class="no-float center-block">Usuarios</h2>
	</div>

	<header>
		<div class="nav col-md-10 col-md-offset-2">
			<nav>
				<ul>
					<li><button class="btn btn-primary">{{HTML::link('/admin/user/create', 'Crear', array(''))}}</button></li>
					<li style="color:#069; margin-left: 5px;">{{ $errors->first('msg') }}</li>
				</ul>
			</nav>			
		</div>
	</header>


	<div class="col-md-10 col-md-offset-2">
		@foreach($usuarios as $u)
			<div class="col-md-3">
				<div class="col-md-10 no-float center-block usuario">
					<h4 id="{{$u->uid}}" style="margin-left:5px;">{{$u->name}}<a href="{{route('user.delete', $u->uid)}}"><span style="margin-right: 4px;" class=
					"icono glyphicon glyphicon-trash pull-right"></span></a><a href="{{route('user.edit', $u->uid)}}"><span style="margin-right: 4px;" class="icono glyphicon glyphicon-pencil pull-right"></span></a> <span style="margin-right: 4px;" class="icono glyphicon glyphicon-chevron-down pull-right drop"></span></h4>
					<img class="img-responsive img-circle avatar-user center-block" src="{{URL::asset('/recursos/' . $u->avatar->url)}}">
					<div class="info oculto-info">
					<p style="margin-left: 4px;">{{$u->name.' '.$u->apellido}}</p>
					<p style="margin-left: 4px;">Username: {{$u->username}}</p>
					</div>
				</div>
			</div>
		@endforeach
	</div>
	<div class="titulo col-md-12 col-md-offset-2 no-float center-block">
		<h2 class="text-center">Usuarios</h2>	
	</div>

	<header>
		<div class="nav col-md-12 col-md-12 col-md-offset-2">
			<nav>
				<ul>
					<li><button class="btn btn-warning">{{HTML::link('/admin/user/create', 'Crear usuario')}}</button></li>
				</ul>
			</nav>
		</div>
	</header>
	<div class="col-md-12 col-md-offset-2">
		@foreach($usuarios as $u)
			<div class="col-md-3">
				<div class="col-md-10 no-float center-block usuario">
					<h4>{{$u->name}}</h4>
					<p>{{$u->username}}</p>
					<p>{{$u->created_at}}</p>
				</div>
			</div>
		@endforeach
	</div>
	-->
@stop