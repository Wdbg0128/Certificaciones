@extends("theme.$theme.layout")
@section('styles')
<link rel="stylesheet" href="{{asset("css/style.css")}}">
@section('scrips')

@endsection
@endsection
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        @section('Name_Vista')
                        <a href="{{ url('/Cotecmar/cer-registros') }}"  title="Ir Atras">
                            <img src="{{asset("assets/$theme/dist/img/long_arrow_left_100px.png")}}" class=" rounded float-left img-fluid" alt="..." width="50px"; id="button-back"></a>
                            <a href="/inicio" title="Ir a Inicio"><img src="{{asset("assets/$theme/dist/img/home_50px.png")}}"  class=" rounded float-left img-fluid" alt="..." width="50px"; id="button-back"></a>
                        <p class="col-md-12 col-md-offset-5"> Nuevo registro</p>
                        @endsection </div>
                        {{-- @include ('../Cotecmar.datos-personales.index') --}}
                        <div class="card-body">

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <form method="POST" action="{{ url('/Cotecmar/cer-registros') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @include ('Cotecmar.cer-registros.form', ['formMode' => 'create'])
                        </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
