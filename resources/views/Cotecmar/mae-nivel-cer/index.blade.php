@extends("theme.$theme.layout")

@section('content')
    <div class="container">
        <div class="row">


            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">@section('Name_Vista')
                        <a href="/" title="Ir a Inicio"><img src="{{asset("assets/$theme/dist/img/home_50px.png")}}"  class=" rounded float-left img-fluid" alt="..." width="50px"; id="button-back"></a>
                        <a href="{{ url('/Cotecmar/mae-certificados/create') }}" title="Agregar nueva certificación">
                            <img src="{{asset("assets/$theme/dist/img/add_new_50px.png")}}" class=" rounded float-left img-fluid" alt="..." width="50px"; id="button-back"></a>
                        Niveles de Certificación
                    @endsection</div>
                    <div class="card-body">

                        <form method="GET" action="{{ url('/Cotecmar/mae-certificados') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Nivel de Certificación</th>
                                        {{-- <th>Estado</th> --}}
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($nivelCer as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nombre_nivel_cer }}</td>
                                        {{-- <td>{{ $item->Estado }}</td> --}}
                                        <td>
                                            <a href="{{ url('/Cotecmar/mae-nivel-cer/' . $item->id . '/edit') }}" title="Editar nivel de certificaión"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
                                            {{-- falta try caht en el controlador
                                            <form method="POST" action="{{ url('/Cotecmar/mae-nivel-cer' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete nivel de certificaión" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</button>
                                            </form> --}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $nivelCer->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
