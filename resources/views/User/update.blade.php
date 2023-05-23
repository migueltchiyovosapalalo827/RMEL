@extends('layouts.starter')
@section('title', 'actualizar')

@include ('layouts.sidebar')

@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Usuarios</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Usuario</a></li>
              <li class="breadcrumb-item active">actualizar</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
<div class="row">

    <div class="col-md-12">
        <div class="card card-outline card-info">
            <div class="card-header">
                <div class="float-left">
                    <div class="btn-group">
                        <a href="{{ route('user.index') }}" class="btn btn-sm btn-block btn-secondary"><i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
            <div class="col-md-12">
        <div class="card card-outline">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link  active " href="#settings" data-toggle="tab">{{'Dados de Acesso'}}</a></li>
                    <li class="nav-item"><a class="nav-link  " href="#funcionarios" data-toggle="tab">{{'Dados Pessoais'}}</a></li>
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <!-- /.tab-pane -->
                    <div class="tab-pane active " id="settings">
                    <form action="{{route('user.update',$user->id) }}" method="post" class="form-horizontal">
                           @method('PUT')
                           @csrf

                            <div class="form-group row">
                                <label for="inputName" class="col-sm-3 col-form-label">{{'email'}}</label>
                                <div class="col-sm-7">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value=" {{$user->email}}" placeholder="email" autocomplete="off">
                                  @error('email')
                                <div class="invalid-feedback">
                                    <h6>{{$message}}</h6>
                                </div>
                                @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-3 col-form-label">{{'nome'}}</label>
                                <div class="col-sm-7">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$user->name}}" placeholder="{{'nome'}}" autocomplete="off">
                               @error('name')
                                <div class="invalid-feedback">
                                    <h6>{{$message}}</h6>
                                </div>
                                @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName2" class="col-sm-3 col-form-label">{{'password'}}</label>
                                <div class="col-sm-7">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input type="password" name="password" class="form-control @error('password') ? is-invalid @enderror" placeholder="{{'password'}}" autocomplete="off">
                                          @error('password')
                                <div class="invalid-feedback">
                                    <h6>{{$message}}</h6>
                                </div>
                                @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName2" class="col-sm-3 col-form-label">{{'repitir Password'}}</label>
                                <div class="col-sm-7">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="<?=('Password')?>" autocomplete="off">
                                @error('password_confirmation')
                                <div class="invalid-feedback">
                                    <h6>{{$message}}</h6>
                                </div>
                                @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Lista de funcão</label>
                                <div class="col-sm-7">
                                <select class="duallistbox" multiple="multiple" name="roles[]">
                                    @foreach($roles as $per)
                                    <option value="{{$per->id}}" {{ $user->hasRole($per->name)  ? 'selected' : '' }}>
                                    {{$per->name}}
                                </option>

                                    @endforeach

                                </select>
                                </div>
                              </div>

                    </div>
                    <div class="tab-pane " id="funcionarios">

  <div class="form-row">
    <div class="form-group col-md-12">
      <label for="nomeCompleto">Nome completo</label>
      <input type="text" class="form-control @error('nome') is-invalid @enderror"  value="{{$funcionario->nome}}" id="nomeCompleto" placeholder="Nome completo" name="nome">

                               @error('nome')
                                <div class="invalid-feedback">
                                    <h6>{{$message}}</h6>
                                </div>
                                @enderror
    </div>
    <div class="form-group col-md-12">
      <label for="bi">Numero do Bi</label>
      <input type="text" class="form-control @error('bi') is-invalid @enderror"  value="{{$funcionario->bi}}" id="bi" placeholder="Numero do Bi" name="bi">
      @error('bi')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-12">
      <label for="nacionalidade">telefone</label>
      <input type="text" class="form-control @error('telefone') is-invalid @enderror"  value="{{$funcionario->contacto}}" id="telefone" name="telefone" placeholder="{{'telefone'}}" autocomplete="off">
      @error('telefone')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-12">
      <label for="nacionalidade">Endereço</label>
      <input type="text" class="form-control @error('endereco') is-invalid @enderror"  value="{{$funcionario->endereco}}" id="endereco" name="endereco" placeholder="{{'endereco'}}" autocomplete="off">
      @error('endereco')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
    </div>

  </div>

          <!-- /.card-body -->
          <div class="card-footer">
          <div class="form-group row">
                           <div class="col-sm-10">
                               <div class="float-right">
                                   <div class="btn-group">
                                       <button type="submit" class="btn btn-sm btn-block btn-primary">
                                       {{'salvar'}}
                                       </button>
                                   </div>
                               </div>
                           </div>
                       </div>
          </div>
        </div>
     </form>
  </div>
                    <!-- /.tab-pane -->

     </div>
                <!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div>
        <!-- /.nav-tabs-custom -->
    </div>
            </div>
        </div>
    </div>
</div>
    </section>
@endsection
@include ('includes.duallistbox')
@include ('layouts.datatable')
@section('script')
@parent
<script>
      $( function() {

      $('#reservation').datepicker()
  } );


</script>
@endsection

