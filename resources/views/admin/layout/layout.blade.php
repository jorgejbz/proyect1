<!DOCTYPE html>
<html lang="en">
<head>
  <head>
    <!-- ... el código que ya tienes -->
    <style>
      /* Cambia el color de fondo del número de página activo */
      .page-item.active .page-link {
        background-color: #A9AC5D !important; /* Cambia esto al color que prefieras */
        border-color: #A9AC5D !important; /* Cambia también el borde */
        color: white !important; /* Cambia el color del texto si es necesario */
      }
    </style>
  </head>
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}"/>
  <link rel="icon" href="{{ asset('admin/img/EcoTrack.jpg') }}" type="image/x-icon">
  <title>Ecotrack | Web </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin/css/adminlte.min.css')}}">
  {{-- select2 --}}
  <link rel="stylesheet" href="{{url('admin/plugins/select2/css/select2.min.css')}}">

  {{-- boton esp32 --}}
<link rel="stylesheet" href="{{ asset('admin/css/led-control.css') }}">
{{-- <script src="{{ asset('admin/css/led-control.css') }}"></script> --}}
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="hold-transition sidebar-mini">
<div class="wrapper">

@include('admin.layout.header')
@include('admin.layout.sidebar')



@yield('content')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  {{-- layout footer --}}
{{-- @include('admin.layout.footer') --}}
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE -->
<script src="{{asset('admin/js/adminlte.js')}}"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{asset('admin/plugins/chart.js/Chart.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('admin/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('admin/js/pages/dashboard3.js')}}"></script>
{{-- custom js --}}
<script src="{{asset('admin/js/custom.js')}}"></script>

{{-- custom2js para la grafica circulars --}}
<script src="{{asset('admin/js/custom2.js')}}"></script>


{{-- select2 --}}
<script src="{{url('admin/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
$('.select2').select2();
</script>

<!-- Carga de Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>



{{-- DATATABLES --}}
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script>
  $(function() {
      // Inicializa la tabla de usuarios activos
      $("#userlist").DataTable();
      
      // Inicializa la tabla de usuarios inactivos
      $("#userlist1").DataTable();
  });
  </script>

</body>
</html>