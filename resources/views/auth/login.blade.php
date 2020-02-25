@extends('layouts.app')
@section('estilos')
<link rel="stylesheet" href="{{asset("css/style.css")}}">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
@endsection
@section('scripts')
<script src="{{asset("js/scripts.js")}}"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
@endsection
@section('content')
<!------ Include the above in your HEAD tag ---------->

<div class="container">

    <div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">

        <div class="row">
            <div class="col-md-12 text-center">
            <img src="{{asset("assets/$theme/dist/img/CotecmarLogo.png")}}"  width="250px" alt="" srcset="">
            </div>
        </div>

        <div class="panel panel-default" >
            <div class="panel-heading">
                <div class="panel-title text-center">CERTIFICACIONES CLG | CONTROL DE ACCESO</div>
            </div>

            <div class="panel-body" >
                <form name="form" id="form" class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{ route('validarlogin') }}">
                    @csrf
                    <div class="input-group" data-validate = "Valid email is required: ex@abc.xyz">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input class="form-control"  id="username" type="text" name="username" placeholder="USUARIO" value="{{ old('username') }}" required autocomplete="username">
                        @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="CONTRASEÑA" required autocomplete="current-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="form-group row">

                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">
                                {{ __('INGRESAR') }}
                            </button>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
