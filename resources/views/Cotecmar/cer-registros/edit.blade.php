@extends("theme.$theme.layout")

@section('styles')
<link rel="stylesheet" href="{{asset("css/style.css")}}">
@endsection

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">

                        @section('Name_Vista')
                        <a title="Ir Atras" ><form method="GET" action="{{ url('/Cotecmar/cer-registros/'. $cerregistro->id) }} " enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input name="username" type="hidden" value="{{ $username }}">  
                            <input name="registro"type="hidden" value="{{$registro}}">
                            <input name="certificado"type="hidden" value="{{$certificado}}">
                            <input name="ente_certificador"type="hidden" value="{{$ente_certificador}}">
                            <input name="nivel"type="hidden" value="{{$nivel}}">
                            <input name="tipo_certificado"type="hidden" value="{{$tipo_certificado}}">
                            <button class="btn" id="button" type="submit" onclick="return confirm(&quot; ¿Desea ir hacia Atras? !No se guardaran los cambios realizados¡&quot;)">
                                <img src="{{asset("assets/$theme/dist/img/long_arrow_left_100px.png")}}" class=" rounded float-left img-fluid" alt="..." width="50px"; id="button-back"></button>
                          </form></a>

                        <a href="/inicio" title="Ir a Inicio">
                            <form method="GET" action="{{ url('/inicio') }} " enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input name="username" type="hidden" value="{{ $username }}">  
                                <input name="registro"type="hidden" value="{{$registro}}">
                                <input name="certificado"type="hidden" value="{{$certificado}}">
                                <input name="ente_certificador"type="hidden" value="{{$ente_certificador}}">
                                <input name="nivel"type="hidden" value="{{$nivel}}">
                                <input name="tipo_certificado"type="hidden" value="{{$tipo_certificado}}">
                                <button class="btn" id="button" type="submit" onclick="return confirm(&quot; ¿Desea ir al inicio? !No se guardaran los cambios realizados¡&quot;)">
                                    <img src="{{asset("assets/$theme/dist/img/home_50px.png")}}" class=" rounded float-left img-fluid" alt="..." width="50px"; id="button-back"></button>
                              </form>
                        </a>
                        <p class="col-md-12 text-center"> Edición
                            {{-- {{ isset($cerregistro->datosPersonales()->first()->Apellidos_Nombres) ? $cerregistro->datosPersonales()->first()->Apellidos_Nombres . ' | '. $cerregistro->certificado()->first()->Nombre_Certificado : $cerregistro->certificado()->first()->Nombre_Certificado}} --}}
                        </p>
                            @endsection </div>

                    <div class="card-body ">

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/Cotecmar/cer-registros/' . $cerregistro->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
                            <input name="username" type="hidden" value="{{ $username }}">  
                            <input name="registro"type="hidden" value="{{$registro}}">
                            <input name="certificado"type="hidden" value="{{$certificado}}">
                            <input name="ente_certificador"type="hidden" value="{{$ente_certificador}}">
                            <input name="nivel"type="hidden" value="{{$nivel}}">
                            <input name="tipo_certificado"type="hidden" value="{{$tipo_certificado}}">
                            @include ('Cotecmar.cer-registros.form', ['formMode' => 'edit'])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
