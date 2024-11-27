@extends('admin.layout.layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">PRUEBA DEL ESP32</h1>
            {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}" style="color: #A9AC5D">Inicio</a></li>
              <li class="breadcrumb-item active">ESP32-1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <body>
      <div class="container">
          <h1>Control de LED</h1>
  
          <p class="status {{ $ledState ? 'on' : 'off' }}">
              Estado del LED: {{ $ledState ? 'Encendido' : 'Apagado' }}
          </p>
  
          <form action="{{ route('led.toggle') }}" method="POST" style="display: inline;">
              @csrf
              <button type="submit" class="button {{ $ledState ? 'off' : '' }}">
                  {{ $ledState ? 'Apagar' : 'Encender' }}
              </button>
          </form>
  
</body>
  
</html>

@endsection