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
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}" style="color: #A9AC5D">Inicio</a></li>
              <li class="breadcrumb-item active">ESP32-1</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <body>
      <div class="container">
          <h1>Control de LED</h1>

          <!-- Estado del LED -->
          <p class="status {{ $ledState ? 'on' : 'off' }}">
              Estado del LED: {{ $ledState ? 'Encendido' : 'Apagado' }}
          </p>

          <!-- Botón para cambiar el estado del LED -->
          <form action="{{ route('led.toggle') }}" method="POST" style="display: inline;">
              @csrf
              <button type="submit" class="button {{ $ledState ? 'off' : '' }}">
                  {{ $ledState ? 'Apagar' : 'Encender' }}
              </button>
          </form>

          <!-- Card para el gráfico -->
          <div class="card mt-4">
              <div class="card-header">
                  <h3 class="card-title">Estado del LED - Gráfico Encendido/Apagado</h3>
              </div>
              <div class="card-body">
                  <!-- Gráfico de estados Encendido/Apagado -->
                  <canvas id="myChart" width="400" height="200"></canvas>
              </div>
          </div>

          <!-- Tabla para mostrar los últimos 10 registros -->
          <div class="card mt-4">
              <div class="card-header">
                  <h3 class="card-title">Últimos 10 Estados del LED</h3>
              </div>
              <div class="card-body">
                  <table class="table table-bordered">
                      <thead>
                          <tr>
                              <th>Estado</th>
                              <th>Timestamp</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($jobs as $job)
                              <tr>
                                  <td>{{ ucfirst($job->state) }}</td>
                                  <td>{{ $job->timestamp }}</td>
                              </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
          </div>

          <!-- Inputs ocultos para pasar los valores de onCount y offCount -->
          <input type="hidden" id="onCount" value="{{ $onCount }}">
          <input type="hidden" id="offCount" value="{{ $offCount }}">

      </div>

      <!-- Incluir el archivo custom.js -->
      <script src="{{ asset('js/custom.js') }}"></script>

    </body>
</div>
@endsection
