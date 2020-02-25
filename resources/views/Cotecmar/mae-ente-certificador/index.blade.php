@extends("theme.$theme.layout")

@section('content')
    <div class="container">
        <div class="row">


            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">@section('Name_Vista')
                        Maeentecertificador
                    @endsection</div>
                    <div class="card-body">
                        <a href="{{ url('/Cotecmar/mae-ente-certificador/create') }}" class="btn btn-success btn-sm" title="Agregar Nuevo Ente Certificador">
                            <i class="fa fa-plus" aria-hidden="true"></i> Agregar
                        </a>

                        <form method="GET" action="{{ url('/Cotecmar/mae-ente-certificador') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                        <th>#</th><th>Nombre EnteCertificador</th><th>Estado</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($maeentecertificador as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->Nombre_EnteCertificador }}</td><td>{{ $item->Estado }}</td>
                                        <td>
                                            <a href="{{ url('/Cotecmar/mae-ente-certificador/' . $item->id . '/edit') }}" title="Edit MaeEnteCertificador"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</button></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $maeentecertificador->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
