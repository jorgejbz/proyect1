@extends('admin.layout.layout')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Alerta de Precaución</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}" style="color: #A9AC5D">Inicio</a></li>
              <li class="breadcrumb-item active">Alertas</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Aquí puedes agregar el contenido principal relacionado con la alerta -->
        <div class="alert alert-warning" role="alert">
          Esta es una alerta de precaución. Por favor, sigue las instrucciones adecuadamente.
        </div>
      </div><!-- /.container-fluid -->
    </section><!-- /.content -->
    <body>
        <div class="container">
            
  
            <!-- Card para el gráfico -->
            <!-- Aquí agregamos el gráfico circular y la tabla -->
          <div class="row mt-4">
              <!-- Columna para el gráfico circular -->
              <div class="col-md-6">
                  <div class="card">
                      <div class="card-header">
                          <h3>Grafica de Alertas </h3>
                      </div>
                      <div class="card-body">
                          <canvas id="alertStateChart" width="400" height="400"></canvas>
                      </div>
                  </div>
              </div>
  
            <!-- Tabla para mostrar los últimos 10 registros -->
            <!-- Columna para la tabla -->
            <div class="col-md-6">
              <div class="card">
                  <div class="card-header">
                      <h3>Últimos 10 registros</h3>
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
                            @foreach($alerts as $alert)
                                <tr>
                                    <td>{{ ucfirst($alert->state) }}</td>
                                    <td>{{ $alert->timestamp }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
  
            <!-- Inputs ocultos para pasar los valores de onCount y offCount -->
            <input type="hidden" id="AlertonCount" value="{{ $AlertonCount }}">
            <input type="hidden" id="AlertoffCount" value="{{ $AlertoffCount }}">
  
        </div>
  
        <!-- Inicializa el gráfico de Chart.js -->
        <script>
          document.addEventListener('DOMContentLoaded', function() {
              const ctx = document.getElementById('alertStateChart').getContext('2d');
              const onCount = document.getElementById('AlertonCount').value;
              const offCount = document.getElementById('AlertoffCount').value;
  
              new Chart(ctx, {
                  type: 'pie',
                  data: {
                      labels: ['Encendido', 'Apagado'],
                      datasets: [{
                          data: [onCount, offCount],
                          backgroundColor: ['#36A2EB', '#FF6384'],
                          borderWidth: 1
                      }]
                  }
              });
          });
        </script>
  
        <!-- Incluir el archivo custom2.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
        {{-- <script src="{{ asset('js/custom2.js') }}"></script> --}}
  
  
      </body>
  </div>
  @endsection
  
