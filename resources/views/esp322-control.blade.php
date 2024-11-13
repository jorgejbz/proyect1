@extends('admin.layout.layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">PRUEBA DEL ESP32 2</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">ESP32 ULTRASONIDO</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <!-- Aquí comienza el cuerpo principal -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h1>Control de Capacidad</h1>
                <!-- El id es para llamar a la función en custom.js para actualizar el nivel de capacidad -->
                Nivel de capacidad actual: <strong id="nivel-capacidad">{{ $nivelCapacidad ?? 'Cargando...' }}%</strong>
              </div>
              <canvas id="nivelCapacidadChart" width="400" height="200"></canvas>

                <!-- Carga de Chart.js -->
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                <!-- Carga de tu archivo custom.js -->
                <script src="{{ asset('admin/js/custom.js') }}"></script>

            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
