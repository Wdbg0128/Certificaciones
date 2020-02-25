@extends("theme.$theme.layout")

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    @section('Name_Vista')
                    <div class="card-header">Editar Ente Certificador #{{ $maeentecertificador->id }}</div>
                    @endsection
                    <div class="card-body">
                        <a href="{{ url('/Cotecmar/mae-ente-certificador') }}" title="Ir atras"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/Cotecmar/mae-ente-certificador/' . $maeentecertificador->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('Cotecmar.mae-ente-certificador.form', ['formMode' => 'edit'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
