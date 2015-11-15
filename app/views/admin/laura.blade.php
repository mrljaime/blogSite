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
        .bloque{
            background-color: #e4e4e7;
            box-shadow:0 0 10px rgba(0, 0, 0, 0.32);
        }
    </style>

    <div class="col-md-10 no-float center-block text-center">
        <h2>Laura</h2>
    </div>

    <div class="col-md-10 no-float center-block">
        <div class="edit-buttons col-md-10 no-float center-block">
            <a class="col-md-4 col-sm-4 col-xs-4" href="{{route('laura.intro')}}"><button class="btn btn-success col-md-10 col-sm-10 col-xs-10 no-float center-block">Introducción</button></a>
            <a class="col-md-4 col-sm-4 col-xs-4" href="#"><button class="btn btn-success col-md-10 col-sm-10 col-xs-10 no-float center-block">Contenido</button></a>
            <a class="col-md-4 col-sm-4 col-xs-4" href="#"><button class="btn btn-success col-md-10 col-sm-10 col-xs-10 no-float center-block">Slider</button></a>
        </div>
    </div>



@stop
