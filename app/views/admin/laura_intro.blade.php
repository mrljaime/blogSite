@extends('admin.index')
@section('title')
    {{$title}}
@stop

@section('script')
@stop

@section('content')
    <style>
        .no-float{
            float: none;
        }
    </style>

    <div class="col-md-10 no-float center-block text-center">
        <h2>Laura - Introducción</h2>
    </div>

    <div class="col-md-10 no-float center-block">
    	<div class="col-md-7 no-float center-block">
    		<label>Título</label>
    			<textarea class="form-control" rows="8">{{$titulo}}</textarea>
    	</div>
    	<div class="col-md-7 no-float center-block">
    		<label>Descripción</label>
    			<textarea class="form-control" rows="8">{{$description}}</textarea>
    	</div>
    </div>


@stop
