@extends("theme.$theme.layout")

@section('content')
    <div class="container">
        <div class="row">


            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">@section('Name_Vista')
                        <a href="{{ url('/Cotecmar/mae-certificados') }}" title="Ir Atras" onclick="return confirm(&quot; ¿Desea ir hacia Atras? !No se guardaran los cambios realizados¡&quot;)">
                            <img src="{{asset("assets/$theme/dist/img/long_arrow_left_100px.png")}}" class=" rounded float-left img-fluid" alt="..." width="50px"; id="button-back"></a>
                            <a href="/inicio" title="Ir a Inicio" onclick="return confirm(&quot; ¿Desea ir a Inicio? !No se guardaran los cambios realizados¡&quot;)"><img src="{{asset("assets/$theme/dist/img/home_50px.png")}}"  class=" rounded float-left img-fluid" alt="..." width="50px"; id="button-back"></a>
                            Editar Certificado N°: {{ $maecertificado->id }}
                            @endsection
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/Cotecmar/mae-certificados/' . $maecertificado->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('Cotecmar.mae-certificados.form', ['formMode' => 'edit'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
