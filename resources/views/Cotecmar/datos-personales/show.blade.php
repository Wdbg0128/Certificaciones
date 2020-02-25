@extends("theme.$theme.layout")

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">DatosPersonale {{ $datospersonale->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/Cotecmar/datos-personales') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/Cotecmar/datos-personales/' . $datospersonale->id . '/edit') }}" title="Edit DatosPersonale"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('Cotecmar/datospersonales' . '/' . $datospersonale->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete DatosPersonale" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $datospersonale->id }}</td>
                                    </tr>
                                    <tr><th> Num Sap </th><td> {{ $datospersonale->Num_Sap }} </td></tr><tr><th> Identificacion </th><td> {{ $datospersonale->Identificacion }} </td></tr><tr><th> Apellidos Nombres </th><td> {{ $datospersonale->Apellidos_Nombres }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
