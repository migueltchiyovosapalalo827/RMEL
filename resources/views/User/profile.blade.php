@extends('layouts.starter')
@section('title', 'Usuarios')

@include ('layouts.sidebar')

@section('content')
 <!-- Content Header (Page header) -->
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Perfil</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Perfil</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<section class="content">
<div class="row">
    <div class="col-md-4">
        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="{{asset('dist/img/avatar.png')}}"
                        alt="User profile picture">
                </div>
                <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>
                <p class="text-muted text-center"><i class="far fa-fw fa-envelope"></i>{{Auth::user()->email}}</p>
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>{{'Conta criada em :'}}</b>
                        <a class="float-right">
                        {{ Auth::user()->created_at }}
                        </a>
                    </li>
                </ul>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-8">
        <div class="card card-outline">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link @if(!session('erro')) active  @endif" href="#settings" data-toggle="tab">{{'informações de segurança'}}</a></li>
                    <li class="nav-item"><a class="nav-link  @if(session('erro')) active  @endif " href="#funcionarios" data-toggle="tab">{{'informações profissionais'}}</a></li>
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <!-- /.tab-pane -->
                    <div class="tab-pane   @if(!session('erro')) active  @endif" id="settings">
                        <form action="" method="post" class="form-horizontal">
                           {{ csrf_field()}}
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-3 col-form-label">{{'email'}}</label>
                                <div class="col-sm-7">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="email" name="email" class="form-control <?= session('error.email') ? 'is-invalid' : '' ?>" value="{{Auth::user()->email}}" placeholder="{{'Auth.email')?>" autocomplete="off">
                                        @if (session('error.email'))
                                        <div class="invalid-feedback">
                                            <h6>{{ session('error.email'}}</h6>
                                        </div>
                                        @endif
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
                                        <input type="text" name="name" class="form-control <?= session('error.username') ? 'is-invalid' : '' ?>" value="{{Auth::user()->name}}" placeholder="{{'Auth.name')?>" autocomplete="off">
                                        @if (session('error.name'))
                                        <div class="invalid-feedback">
                                             <h6> {{session('error.name'}}</h6>
                                        </div>
                                    @endif
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
                                        <input type="password" name="password" class="form-control <?= session('error.password') ? 'is-invalid' : '' ?>" placeholder="{{'password')?>" autocomplete="off">
                                         @if (session('error.password'))
                                        <div class="invalid-feedback">
                                            <h6>{{ session('error.password')}}</h6>
                                        </div>
                                      @endif
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
                                        <input type="password" name="pass_confirm" class="form-control <?= session('error.pass_confirm') ? 'is-invalid' : '' ?>" placeholder="{{'Auth.repeatPassword')?>" autocomplete="off">
                                        @if (session('error.pass_confirm'))
                                        <div class="invalid-feedback">
                                            <h6>{{ session('error.pass_confirm')}}</h6>
                                        </div>
                                      @endif
                                    </div>
                                </div>
                            </div>
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
                        </form>
                    </div>
                    <div class="tab-pane   @if(session('erro')) active  @endif" id="funcionarios">
                        <form action="{{route('perfil',Auth::user()->id)}}" method="post" class="form-horizontal">
                           {{ csrf_field()}}
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-3 col-form-label">{{'endereço'}}</label>
                                <div class="col-sm-7">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="text" name="endereco"  class="form-control  @error('endereco') is-invalid @enderror" value="{{session('error.endereco')? old('endereco'):$funcionario->endereco}}" placeholder="{{'endereço'}}" autocomplete="off">
                                            @error('endereco')
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
                                        <input type="text" name="nome" class="form-control @error('nome') is-invalid  @enderror" value="{{$funcionario->nome}}" placeholder="{{'nome'}}" autocomplete="off">
                                        @error('nome')
                                        <div class="invalid-feedback">
                                             <h6> {{$message}}</h6>
                                        </div>
                                    @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName2" class="col-sm-3 col-form-label">{{'Numero do BI'}}</label>
                                <div class="col-sm-7">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas  fa-id-card"></i></span>
                                        </div>
                                        <input type="text" name="bi" class="form-control @error('bi') is-invalid @enderror" placeholder="{{$funcionario->bi}}" value="{{$funcionario->bi}}" autocomplete="off">
                                         @error('bi')
                                        <div class="invalid-feedback">
                                            <h6>{{$message}}</h6>
                                        </div>
                                      @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName2" class="col-sm-3 col-form-label">{{'telefone'}}</label>
                                <div class="col-sm-7">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas  fa-mobile"></i></span>
                                        </div>
                                        <input type="text" name="contacto" class="form-control @error('contacto') is-invalid @enderror" placeholder="{{$funcionario->contacto}}" autocomplete="off"  value="{{$funcionario->contacto}}">
                                        @error('contacto')
                                        <div class="invalid-feedback">
                                            <h6>{{$message}}</h6>
                                        </div>
                                      @enderror
                                    </div>
                                </div>
                            </div>
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
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div>
        <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
</div>
</section>
@endsection
