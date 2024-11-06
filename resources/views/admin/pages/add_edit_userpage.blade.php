@extends('admin.layout.layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            @if(isset($user) && $user->exists)  <!-- Verifica si el usuario existe -->
            <h1 class="m-0">Editar Usuario de la AppMovil</h1>
        @else
            <h1 class="m-0">Agregar Nuevo Usuario</h1>
        @endif
                  </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{ isset($user) && $user->exists ? 'Actualizar Perfil de Usuario Movil' : 'Agregar Usuario' }}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
        <!-- Profile Image (Left Column) -->
        @if($user->exists)  <!-- Esto se asegura de que solo se muestre si el usuario existe -->
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Perfil del Usuario</h3>
                </div>
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img src="{{ asset('admin/img/no-images.jpg') }}" class="profile-user-img img-fluid img-circle" alt="User Image">
                    </div>

                    <h3 class="profile-username text-center">{{ $user->name }}</h3>
                    <p class="text-muted text-center">{{ $user->position }}</p>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Email</b> <a class="float-right">{{ $user->email }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Puesto</b> <a class="float-right">{{ $user->position }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @endif


          <!-- Update User Details (Right Column) -->
          <div class="col-md-{{ isset($user->id) ? '9' : '12' }}">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
              </div>

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

              <!-- Formulario para actualizar datos -->
                <form method="POST" id="userForm" action="{{ isset($user->id) ? url('/admin/add-edit-user-page/' . $user->id) : url('/admin/add-edit-user-page') }}" enctype="multipart/form-data">
                  @csrf
                  {{-- @if($user->exists) --}}
                  @if(isset($user) && $user->exists) <!-- Si es edición -->
                  <input type="hidden" name="user_id" value="{{ $user->_id }}">

                  <div class="card-body">
                            <!-- Campo Código -->
                    <div class="form-group">
                      <label for="user_code">Código</label>
                      <input type="text" class="form-control" name="user_code" value="{{ $user->code }}" required>
                    </div>
                            <!-- Campo Correo -->
                    <div class="form-group">
                      <label for="user_email">Correo Electrónico</label>
                      <input type="email" class="form-control" name="user_email"  value="{{$user->email}}" required readonly>
                    </div>
                            <!-- Campo Nombre -->
                    <div class="form-group">
                      <label for="user_name">Nombre</label>
                      <input type="text" class="form-control" name="user_name" value="{{ $user->name }}" required>
                    </div>
                            <!-- Campo Puesto -->
                    <div class="form-group">
                      <label for="user_position">Puesto</label>
                      <input type="text" class="form-control" name="user_position"  value="{{ $user->position }}" required>
                    </div>
                            <!-- Campo Contraseña (Solo obligatorio para crear usuario) -->
                    <div class="form-group">
                      <label for="user_password">Contraseña (Dejar en blanco para no cambiar)</label>
                      <input type="password" class="form-control" name="user_password" >
                    </div>
                  </div>
                @else
                  <div class="card-body">
                    <!-- Crear nuevo usuario -->
                            <!-- Campo Código -->
                          <div class="form-group">
                            <label for="user_code">Código</label>
                            <input type="text" class="form-control" name="user_code"  required>
                          </div>
                            {{-- Campo Correo--}}
                          <div class="form-group">
                            <label for="user_email">Correo Electrónico</label>
                            <input type="email" class="form-control" name="user_email" required>
                          </div>                          
                            <!-- Campo Nombre -->
                          <div class="form-group">
                            <label for="user_name">Nombre</label>
                            <input type="text" class="form-control" name="user_name"  required>
                          </div>
                            <!-- Campo Puesto -->
                          <div class="form-group">
                            <label for="user_position">Puesto</label>
                            <input type="text" class="form-control" name="user_position"  required>
                          </div>
                            <!-- Campo Contraseña (Solo obligatorio para crear usuario) -->
                          <div class="form-group">
                            <label for="user_password">Contraseña</label>
                            <input type="password" class="form-control" name="user_password"  required>
                          </div>
                  </div>
                @endif
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">{{ isset($user) && $user->exists ? 'Actualizar Usuario' : 'Crear Usuario' }}</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>
@endsection
