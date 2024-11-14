@extends('admin.layout.layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Administrar Usuarios de App Movil</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Inicio</a></li>
              <li class="breadcrumb-item active">Ver Usuarios App Movil</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    @if(Session::has('success_message')) <div class="alert alert-success alert-dismissible fade show" role="alert" style=" margin : 5px;"> <strong>Success!</strong> {{ Session::get('success_message')}} <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true" >&times;</span> </button> </div> @endif
{{-- Mensaje de borrar usuarios --}}
@if(Session::has('error_message'))
<div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 5px">
  <strong>Success!</strong> {{Session::get('error_message')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
{{-- Mensaje de usuarios inactivos --}}
@if(Session::has('inac_message'))
<div class="alert alert-warning alert-dismissible fade show" role="alert" style="margin-top: 5px">
  <strong>Success!</strong> {{Session::get('inac_message')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
    <!-- Main content -->
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Usuarios Activos App Movil</h3>
              <a style="max-width: 200px; float:right; display:inline-block;" href="{{url('admin/add_userpage')}}" class="btn btn-block btn-primary">Agregar Nuevo Usuario</a>
            </div>
            <!-- /.card-header -->

            {{-- tabla de usuarios activos --}}
            <div class="card-body">
              <table id="userlist" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Codigo de Usuario</th>
                  <th>Nombre</th>
                  <th>Puesto</th>
                  <th>Correo Electronico</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($user_list as $page)
                    @if($page->code && $page->name && $page->position && $page->email && $page->status==1)
                    <tr>
                    <td>{{ $page->code }}</td>
                    <td>{{ $page->name }}</td>
                    <td>{{ $page->position }}</td>
                    <td>{{ $page->email }}</td>
                    {{-- <td>{{ $page->status }}</td> --}}
                    {{-- botones de acciones --}}
                    <td>
                        <a title="Editar Datos de Usuario" href="{{url('admin/add-edit-user-page/'.$page->_id)}}"><i class="fas fa-edit"></i></a> &nbsp;&nbsp;
                        <a title="Eliminar Usuario" href="{{url('admin/delete-user-page/'.$page->id)}}" record="page" recordid="{{$page->_id}}"><i class="fas fa-trash"></i></a> &nbsp;&nbsp;
                        @if($page->status == 1)
                            <a class="updateUserStatus" id="page-{{$page->_id}}" page_id="{{$page->_id}}" href="javascript:void(0)">
                                <i class="fas fa-toggle-on" aria-hidden="true" status="Active"></i>
                            </a>
                        @else
                            <a class="updateUserStatus" id="page-{{$page->_id}}" page_id="{{$page->_id}}" href="javascript:void(0)">
                                <i style="color: grey" class="fas fa-toggle-off" aria-hidden="true" status="Inactive"></i>
                            </a>
                        @endif
                    </td>
                    </tr>
                    @endif
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Usuarios Inactivos App Movil</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table id="userlist1" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>Codigo de Usuario</th>
                        <th>Nombre</th>
                        <th>Puesto</th>
                        <th>Correo Electronico</th>
                        <th>Acciones</th>
                      </tr>
                      </thead>
                      <tbody>
                        @foreach ($user_list as $page)
                        @if($page->code && $page->name && $page->position && $page->email && $page->status==0)
                        <tr>
                        <td>{{ $page->code }}</td>
                        <td>{{ $page->name }}</td>
                        <td>{{ $page->position }}</td>
                        <td>{{ $page->email }}</td>
                        {{-- <td>{{ $page->status }}</td> --}}
                        <td>
                            <a title="Editar Datos de Usuario" href="{{url('admin/add-edit-user-page/'.$page->_id)}}"><i class="fas fa-edit"></i></a> &nbsp;&nbsp;
                        <a title="Eliminar Usuario" href="{{url('admin/delete-user-page/'.$page->id)}}" record="page" recordid="{{$page->_id}}"><i class="fas fa-trash"></i></a> &nbsp;&nbsp;
                        @if($page->status == 1)
                            <a class="updateUserStatus" id="page-{{$page->_id}}" page_id="{{$page->_id}}" href="javascript:void(0)">
                                <i class="fas fa-toggle-on" aria-hidden="true" status="Active"></i>
                            </a>
                        @else
                            <a class="updateUserStatus" id="page-{{$page->_id}}" page_id="{{$page->_id}}" href="javascript:void(0)">
                                <i style="color: grey" class="fas fa-toggle-off" aria-hidden="true" status="Inactive"></i>
                            </a>
                        @endif
                        </td>
                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                  </table>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@endsection