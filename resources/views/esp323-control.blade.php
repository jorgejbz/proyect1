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

</div><!-- /.content-wrapper -->
@endsection
