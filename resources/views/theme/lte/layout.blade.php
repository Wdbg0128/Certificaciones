<!DOCTYPE html>
<html>
    <head>
         <meta charset="utf-8">
         <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <title>@yield('Titulo','CCLG') | COTECMAR</title>
         <!-- Tell the browser to be responsive to screen width -->
         <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
         <!-- Bootstrap 3.3.7 -->
         <link rel="stylesheet" href="{{asset("assets/$theme/bower_components/bootstrap/dist/css/bootstrap.min.css")}}">
         <!-- Font Awesome -->
         <link rel="stylesheet" href="{{asset("assets/$theme/bower_components/font-awesome/css/font-awesome.min.css")}}">
         <!-- Ionicons -->
         <link rel="stylesheet" href="{{asset("assets/$theme/bower_components/Ionicons/css/ionicons.min.css")}}">
         <!-- Theme style -->
         <link rel="stylesheet" href="{{asset("assets/$theme/dist/css/AdminLTE.min.css")}}">
         <!-- AdminLTE Skins. Choose a skin from the css/skins
              folder instead of downloading all of them to reduce the load. -->
         <link rel="stylesheet" href="{{asset("assets/$theme/dist/css/skins/_all-skins.min.css")}}">

         {{-- {!!Html::style('css/app.css')!!} --}}
         @yield('styles')

         <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
         <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
         <!--[if lt IE 9]>
         <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
         <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
         <![endif]-->

           <!-- Google Font -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition skin-blue fixed sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">
        {{-- Inicio Header --}}
        <header class="main-header">
            <!-- Logo -->
            <a href="/" class="logo">
              <!-- mini logo for sidebar mini 50x50 pixels -->
              <span class="logo-mini"><b><img src="{{asset("assets/$theme/dist/img/CotecmarLogo(2).PNG")}}" class="img" alt="User Image"></b></span>
              <!-- logo for regular state and mobile devices -->
              <span class="logo-lg"><b></b>CCLG | COTECMAR</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
              <!-- Sidebar toggle button-->
              <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                {{-- <span class="sr-only">Toggle navigation</span> --}}
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </a>

              <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                  <!-- Messages: style can be found in dropdown.less-->

                  <!-- Tasks: style can be found in dropdown.less -->

                  <!-- User Account: style can be found in dropdown.less -->
                  <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <img src="{{asset("assets/$theme/dist/img/user_50px.png")}}" class="user-image" alt="User Image">
                      <span class="hidden-xs">{{strtoupper(isset($username)? $username : 'Usuario')}}</span>
                    </a>
                    <ul class="dropdown-menu">
                      <!-- User image -->
                      <li class="user-header">
                        <img src="{{asset("assets/$theme/dist/img/user_50px.png")}}" class="img-circle" alt="User Image">

                        <p>{{strtoupper(isset($username)? $username : 'Usuario')}}
                         
                          <small><?php
                          setlocale(LC_ALL,"es_ES");
                            echo date("d/n/Y");
                            ?></small>
                        </p>
                      </li>
                      <!-- Menu Body -->
                      <li class="user-body">
                        <div class="row">

                        </div>
                        <!-- /.row -->
                      </li>
                      <!-- Menu Footer-->
                      <li class="user-footer">

                        <div >
                            <button type="button" class="btn btn-block btn-primary btn-flat" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                Salir
                        </button>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                      </li>
                    </ul>
                  </li>
                  {{-- <!-- Control Sidebar Toggle Button -->
                  <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                  </li> --}}
                </ul>
              </div>
            </nav>
        </header>
        {{-- @include("theme/$theme/header") --}}
        {{-- Fin Header --}}
        {{-- Inicio Aside --}}
        <!-- Left side column. contains the sidebar -->
        <aside class="main-sidebar">
          <!-- sidebar: style can be found in sidebar.less -->
          <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
              <div class="pull-left image">
                <img src="{{asset("assets/$theme/dist/img/user_50px.png")}}" class="img-circle" alt="User Image">
              </div>
              <div class="pull-left info">
                <p>{{strtoupper(isset($username)? $username : 'Usuario')}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
              </div>
            </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENU DE NAVEGACIÓN</li>
                <li class="treeview active" >
                @if ($registro == true)
                      <li>
                        <a><form method="GET" action="{{ url('Cotecmar/cer-registros') }} " enctype="multipart/form-data">
                          {{ csrf_field() }}
                          <input name="username" type="hidden" value="{{ $username }}">  
                          <input name="registro"type="hidden" value="{{$registro}}">
                          <input name="certificado"type="hidden" value="{{$certificado}}">
                          <input name="ente_certificador"type="hidden" value="{{$ente_certificador}}">
                          <input name="nivel"type="hidden" value="{{$nivel}}">
                          <input name="tipo_certificado"type="hidden" value="{{$tipo_certificado}}">
                          <button id="btActionRegistro" type="submit"  style="outline:none; border-top:0px; border-right:0px; border-left:0px; border-bottom:0px; background-color:#222D32;  solid #222D32" 
                            ><i class="fa fa-list"></i> Registros</button>
                        </form></a>
                    </li>
                @endif
                @if ($certificado = true)
                      <li>
                        <a><form method="GET" action="{{ url('Cotecmar/mae-certificados') }} " enctype="multipart/form-data">
                          {{ csrf_field() }}
                          <input name="username" type="hidden" value="{{ $username }}">  
                          <input name="registro"type="hidden" value="{{$registro}}">
                          <input name="certificado"type="hidden" value="{{$certificado}}">
                          <input name="ente_certificador"type="hidden" value="{{$ente_certificador}}">
                          <input name="nivel"type="hidden" value="{{$nivel}}">
                          <input name="tipo_certificado"type="hidden" value="{{$tipo_certificado}}">
                          <button id="btActionRegistro" type="submit"  style="outline:none; border-top:0px; border-right:0px; border-left:0px; border-bottom:0px; background-color:#222D32;  solid #222D32" 
                            ><i class="fa fa-mortar-board"></i> Certificados</button>
                        </form></a>
                    </li>
                @endif
                @if ($ente_certificador = true)
                        <li>
                        <a><form method="GET" action="{{ url('Cotecmar/mae-ente-certificador') }} " enctype="multipart/form-data">
                          {{ csrf_field() }}
                          <input name="username" type="hidden" value="{{ $username }}">  
                          <input name="registro"type="hidden" value="{{$registro}}">
                          <input name="certificado"type="hidden" value="{{$certificado}}">
                          <input name="ente_certificador"type="hidden" value="{{$ente_certificador}}">
                          <input name="nivel"type="hidden" value="{{$nivel}}">
                          <input name="tipo_certificado"type="hidden" value="{{$tipo_certificado}}">
                          <button id="btActionRegistro" type="submit"  style="outline:none; border-top:0px; border-right:0px; border-left:0px; border-bottom:0px; background-color:#222D32;  solid #222D32" 
                            ><i class="fa fa-university"></i> Entes Certificadores</button>
                        </form></a>
                    </li>
                @endif
                @if ($nivel = true)
              
                    <li>
                        <a><form method="GET" action="{{ url('Cotecmar/mae-nivel-cer') }} " enctype="multipart/form-data">
                          {{ csrf_field() }}
                          <input name="username" type="hidden" value="{{ $username }}">  
                          <input name="registro"type="hidden" value="{{$registro}}">
                          <input name="certificado"type="hidden" value="{{$certificado}}">
                          <input name="ente_certificador"type="hidden" value="{{$ente_certificador}}">
                          <input name="nivel"type="hidden" value="{{$nivel}}">
                          <input name="tipo_certificado"type="hidden" value="{{$tipo_certificado}}">
                          <button id="btActionRegistro" type="submit"  style="outline:none; border-top:0px; border-right:0px; border-left:0px; border-bottom:0px; background-color:#222D32;  solid #222D32" 
                            ><i class="fa fa-external-link-square"></i> Niveles de Certificación</button>
                        </form></a>
                    </li>
                @endif
                @if ($tipo_certificado = true)
                    <li> 
                        <a><form method="GET" action="{{ url('Cotecmar/mae-tipo-cer') }} " enctype="multipart/form-data">
                          {{ csrf_field() }}
                          <input name="username" type="hidden" value="{{ $username }}">  
                          <input name="registro"type="hidden" value="{{$registro}}">
                          <input name="certificado"type="hidden" value="{{$certificado}}">
                          <input name="ente_certificador"type="hidden" value="{{$ente_certificador}}">
                          <input name="nivel"type="hidden" value="{{$nivel}}">
                          <input name="tipo_certificado"type="hidden" value="{{$tipo_certificado}}">
                          <button id="btActionRegistro" type="submit"  style="outline:none; border-top:0px; border-right:0px; border-left:0px; border-bottom:0px; background-color:#222D32;  solid #222D32" 
                            ><i class="fa fa-deviantart"></i> Tipos de Certificados</button>
                        </form></a>
                    </li> --}}
                @endif
                      {{-- <li><a href={{url('Cotecmar/datos-personales')}}><i class="fa  fa-users"></i>Datos Personales</a></li> --}}
                    {{-- </ul> --}}
                </li>
        </ul>
          </section>
          <!-- /.sidebar -->
        </aside>
        {{-- @include("theme/$theme/aside") --}}
        {{-- Fin Aside --}}
        {{-- Inicio del Contenido  --}}
        <div class="content-wrapper">
                {{--Inicio Miga de pan --}}
            <div class="content-header" id="contenido1">
                 <h1>
                     @yield('Name_Vista','Vista Principal')
                 </h1>

            </div>
            {{-- Fin Miga de pan --}}

            <div class="row" id="contenido">
                <div class="col-md-7 mb-3 col-md-offset-2">
                    @include('flash-message')
                </div>
                    @yield('content')
            </div>
                 {{-- Contenido  --}}
        </div>
                   <!-- /.box -->
            {{-- Fin del Contenido --}}
        </div>
        {{-- Inicio Footer --}}
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
              <b>Version</b> 1.0
            </div>
            <strong>Copyright &copy; 2020 <a href="https://www.Cotecmar.com">COTECMAR</a></strong>
            Todos los derechos reservados.
        </footer>
        {{-- @include("theme/$theme/footer") --}}
        {{-- Fin Footer --}}
        </div>
        <!-- jQuery 3 -->
      <script src="{{asset("assets/$theme/bower_components/jquery/dist/jquery.min.js")}}"></script>
      <!-- Bootstrap 3.3.7 -->
      <script src="{{asset("assets/$theme/bower_components/bootstrap/dist/js/bootstrap.min.js")}}"></script>
      <!-- SlimScroll -->
      <script src="{{asset("assets/$theme/bower_components/jquery-slimscroll/jquery.slimscroll.min.js")}}"></script>
      <!-- FastClick -->
      <script src="{{asset("assets/$theme/bower_components/fastclick/lib/fastclick.js")}}"></script>
      <!-- AdminLTE App -->
      <script src="{{asset("assets/$theme/dist/js/adminlte.min.js")}}"></script>
      <!-- AdminLTE for demo purposes -->
      <script src="{{asset("assets/$theme/dist/js/demo.js")}}"></script>
     <script>
      $(document).ready(function() {
        $('#TodosRedistros').DataTable({
            "language":Idioma,
            "order": [[ 6,"asc" ],[ 0, "asc"]],
                "scrollY":320,
                "scrollColapse": true,
                "paging":false,
                });;
          });
 $(document).ready(function() {
    $('#Personas').DataTable({
        "language":Idioma,
            "scrollY":200,
            "scrollColapse": true,
            "paging":false,

        });
    });
    $(document).ready(function() {
    $('#Certificado').DataTable({
        "language":Idioma,
            "scrollY":200,
            "scrollColapse": true,
            "paging":false,
    });
});
      </script>
      @yield('scripts')
    </body>
</html>

