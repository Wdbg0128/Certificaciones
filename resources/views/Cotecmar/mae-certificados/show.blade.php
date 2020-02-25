@extends("theme.$theme.layout")

@section('content')
    <div class="container">
        <div class="row">


            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">MaeCertificado {{ $maecertificado->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/Cotecmar/mae-certificados') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/Cotecmar/mae-certificados/' . $maecertificado->id . '/edit') }}" title="Edit MaeCertificado"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('Cotecmar/maecertificados' . '/' . $maecertificado->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete MaeCertificado" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $maecertificado->id }}</td>
                                    </tr>
                                    <tr><th> Nombre Certificado </th><td> {{ $maecertificado->Nombre_Certificado }} </td></tr><tr><th> Estado </th><td> {{ $maecertificado->Estado }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
