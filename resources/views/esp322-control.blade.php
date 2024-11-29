@extends('admin.layout.layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Nivel de la Capacidad Total</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}" style="color: #A9AC5D">Inicio</a></li>
              <li class="breadcrumb-item active">Nivel</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

<!-- Aquí comienza el cuerpo principal -->
<div class="content">
  <div class="container-fluid">
      <div class="row">
          <!-- Card para el control de capacidad -->
          <div class="col-lg-12">
              <div class="card">
                  <div class="card-header">
                      <h1 class="card-title">Control de Capacidad</h1>
                  </div>
                  <div class="card-body">
                      <!-- Información del nivel de capacidad -->
                      <p>Nivel de capacidad actual: <strong id="nivel-capacidad">{{ $nivelCapacidad ?? 'Cargando...' }}%</strong></p>
                  </div>
              </div>
          </div>

          <!-- Card para el gráfico de nivel de capacidad -->
          <div class="col-lg-12">
              <div class="card">
                  <div class="card-header">
                      <h3 class="card-title">Gráfico en Tiempo Real</h3>
                  </div>
                  <div class="card-body">
                      <!-- Lienzo para Chart.js -->
                      <canvas id="nivelCapacidadChart" width="400" height="128"></canvas>
                    </div>
              </div>
          </div>
      </div>
  </div>
</div>

<!-- Carga de Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Carga de tu archivo custom.js -->
<script src="{{ asset('admin/js/custom.js') }}"></script>

@endsection
