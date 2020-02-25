@extends("theme.$theme.layout")

@section('content')
    <div class="container">
        <div class="row">


            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        @section('Name_Vista')
                        <a href="{{ url('/Cotecmar/mae-tipo-cer') }}" title="Ir Atras" onclick="return confirm(&quot; ¿Desea ir hacia Atras? !No se guardara el nuevo registro¡&quot;)">
                            <img src="{{asset("assets/$theme/dist/img/long_arrow_left_100px.png")}}" class=" rounded float-left img-fluid" alt="..." width="50px"; id="button-back"></a>
                            <a href="/" title="Ir a Inicio"><img src="{{asset("assets/$theme/dist/img/home_50px.png")}}"  class=" rounded float-left img-fluid" alt="..." width="50px"; id="button-back"></a>
                            Creación de tipo de certificación
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

                        <form method="POST" action="{{ url('/Cotecmar/mae-tipo-cer') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            @include ('Cotecmar.mae-tipo-cer.form', ['formMode' => 'create'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
