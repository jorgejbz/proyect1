@extends('admin.layout.layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Agregar Nuevo Administrador</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Inicio</a></li>
                        <li class="breadcrumb-item active">Agregar Administrador</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    

    {{-- Mensaje de error --}}
    @if(Session::has('error_message'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert" style="margin-top: 5px">
      <strong>Error!</strong> {{Session::get('error_message')}}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif

    {{-- Mensaje de éxito --}}
    @if(Session::has('success_message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 5px">
      <strong>Success!</strong> {{Session::get('success_message')}}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 5px">
    <ul>
    @foreach ($errors->all() as $error)
    <li>{{$error}}</li>
    @endforeach
    </ul>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>
    @endif

    <!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <!-- Centered column -->
      <div class="col-md-7">
        <!-- General form elements -->
        <div class="card card-primary">
          <div class="card-header" style="background-color: #A9AC5D">
            <h3 class="card-title">Agregar Nuevo Administrador</h3>
          </div>
    <!-- Formulario para agregar usuario -->
    <form method="post" action="{{url('/admin/admin_register')}}">@csrf
      <div class="card-body">
        <!-- Campos del formulario -->
        <div class="form-group">
            <label for="admin_email">Correo Electrónico</label>
            <input type="email" class="form-control" name="admin_email" id="admin_email"required>
        </div>
        <div class="form-group">
            <label for="admin_name">Nombre</label>
            <input type="text" class="form-control" name="admin_name" id="admin_name" required>
        </div>
        <div class="form-group">
            <label for="admin_mobile">Numero</label>
            <input type="text" class="form-control" name="admin_mobile" id="admin_mobile" required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" class="form-control" name="password" id="password" required>
        </div>
        <button type="submit" class="btn btn-primary" style="background-color: #A9AC5D; outline: none; border: none;">Registrar Administrador</button>
      </form>
</div>
</div>
@endsection
