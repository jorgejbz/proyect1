@extends('admin.layout.layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Bienvenido {{ Auth::guard('admin')->user()->name }}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}" style="color: #A9AC5D">Inicio</a></li>
            <li class="breadcrumb-item active">Vista Rapida</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- Gráfico de la tolva -->
        <div class="col-lg-8">
          <div class="card" style="width: 100%; margin: auto;">
            <div class="card-header border-0" style="background-color: #A9AC5D">
              <div class="d-flex justify-content-between">
                <h3 class="card-title">Registro de almacenamiento de tolva</h3>
                <a href="{{ url('admin/capacitycontrol') }}" style="color: #E8E1DB !important; font-weight: bold;">Ver datos</a>
              </div>
            </div>
            <div class="card-body">
              <div class="d-flex">
                <p class="d-flex flex-column">
                  <span class="text-bold text-sm"><strong id="nivel-capacidad">{{ $nivelCapacidad ?? 'Cargando...' }}%</strong></span>
                  <span class="text-sm">Nivel de Llenado</span>
                </p>
              </div>
              <!-- Gráfico de la tolva -->
              <div class="position-relative mb-4">
                <canvas id="nivelCapacidadChart" height="137" width="400"></canvas>
              </div>
            </div>
          </div>
        </div>

        <!-- Gráfico de Encendido/Apagado -->
        <div class="col-lg-4">
          <div class="card" style="width: 100%; margin: auto;">
            <div class="card-header border-0" style="background-color: #A9AC5D">
              <div class="d-flex justify-content-between">
                <h3 class="card-title">Registro de Llenado</h3>
                <a href="{{ route('led') }}" style="color: #E8E1DB !important; font-weight: bold;">Ver Más</a>
              </div>
            </div>
            <div class="card-body">
              <!-- Gráfico de Encendido/Apagado -->
              <div class="position-relative mb-4">
                <canvas id="ledStateChart"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->

      <!-- Nueva fila para el gráfico circular centrado -->
      <div class="row mt-4 justify-content-center">
        <div class="col-lg-4">
          <div class="card" style="width: 100%; margin: auto;">
            <div class="card-header border-0" style="background-color: #A9AC5D">
              <div class="d-flex justify-content-between">
                <h3 class="card-title">Registro de Alertas</h3>
                <a href="{{ route('alert') }}" style="color: #E8E1DB !important; font-weight: bold;">Ver Más</a>
              </div>
            </div>
            <div class="card-body">
              <!-- Gráfico circular de alertas -->
              <div class="position-relative mb-4">
                <canvas id="alertStateChart" height="137" width="400"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->

      <!-- Carga de Chart.js -->
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

      <script>
        document.addEventListener('DOMContentLoaded', function() {
          // Gráfico de Encendido/Apagado
          const ledCtx = document.getElementById('ledStateChart').getContext('2d');
          const onCount = {{ $onCount }};
          const offCount = {{ $offCount }};

          new Chart(ledCtx, {
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

          // Gráfico circular de alertas
          const alertCtx = document.getElementById('alertStateChart').getContext('2d');
          const AlertOnCount = {{ $AlertOnCount }};
          const AlertOffCount = {{ $AlertOffCount }};

          new Chart(alertCtx, {
            type: 'pie',
            data: {
              labels: ['Alerta Activa', 'Alerta Inactiva'],
              datasets: [{
                data: [AlertOnCount, AlertOffCount],
                backgroundColor: ['#36A2EB', '#FF6384'],
                borderWidth: 1
              }]
            }
          });
        });
      </script>

      <style>
        #alertStateChart, #ledStateChart {
          width: 100% !important;
          height: 325px !important;
        }
      </style>

    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
