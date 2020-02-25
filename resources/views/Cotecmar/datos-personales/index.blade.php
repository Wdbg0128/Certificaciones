@extends("theme.$theme.layout")

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Datospersonales</div>
                    <div class="card-body">
                        <a href="{{ url('/Cotecmar/datos-personales/create') }}" class="btn btn-success btn-sm" title="Add New DatosPersonale">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/Cotecmar/datos-personales') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                        <th>#</th>
                                        <th>Num Sap</th>
                                        <th>Identificacion</th>
                                        <th>Apellidos Nombres</th>
                                        <th>Gerencia</th>
                                        <th>Planta</th>
                                        <th>Cargo</th>
                                        <th>Fin Contrato</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($datospersonales as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->Num_Sap }}</td><td>{{ $item->Identificacion }}</td><td>{{ $item->Apellidos_Nombres }}</td>
                                       <td>{{ $item->Gerencia }}</td>
                                       <td>{{ $item->Planta}}</td>
                                       <td>{{ $item->Cargo}}</td>
                                       <td>{{ $item->Fin_Contrato }}</td>
                                        <td>
                                            <a href="{{ url('/Cotecmar/datos-personales/' . $item->id) }}" title="View DatosPersonale"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/Cotecmar/datos-personales/' . $item->id . '/edit') }}" title="Edit DatosPersonale"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/Cotecmar/datos-personales' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete DatosPersonale" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $datospersonales->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
