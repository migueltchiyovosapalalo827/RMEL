@extends('layouts.starter')
@section('title', 'novo  professor')

@include ('layouts.sidebar')

@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Actualizar funcionario</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"> Funcionarios</li>
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
                        <a href="{{ route('docente.index') }}" class="btn btn-sm btn-block btn-secondary"><i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
            <div class="col-md-12">
        <div class="card card-outline">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link  active " href="#funcionarios" data-toggle="tab">{{'Formulario de cadastro de Professores ou Pessoal não docente'}}</a></li>
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane  active" id="funcionarios">
                    <form action="{{ route('docente.update', $professor->id) }}" method="post" class="form-horizontal">
                    @method('PUT')
                     @csrf
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="nomeCompleto">Nome completo</label>
      <input type="text" class="form-control @error('nome') is-invalid @enderror"  value="{{$professor->nome}}" id="nomeCompleto" placeholder="Nome completo" name="nome" autocomplete="off">

                               @error('nome')
                                <div class="invalid-feedback">
                                    <h6>{{$message}}</h6>
                                </div>
                                @enderror
    </div>
    <div class="form-group col-md-6">
      <label for="bi">Numero do Bi</label>
      <input type="text" class="form-control @error('bi') is-invalid @enderror"   id="bi" placeholder="Numero do Bi" value="{{$professor->numerobi}}" name="bi" autocomplete="off">
      @error('bi')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
    </div>
  </div>
  <div class="form-row">
  <div class="form-group col-md-4">
      <label for="idade">idade</label>
      <input type="number" class="form-control @error('idade') is-invalid @enderror"  value="{{$professor->idade}}" id="idade" name="idade" autocomplete="off">
      @error('idade')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror

    </div>
    <div class="form-group col-md-4">
      <label for="sexo">Sexo</label>
      <select id="sexo" class="form-control @error('sexo') is-invalid @enderror"  name="sexo">
        <option selected>Seleciona...</option>
        <option value="masculino"  {{  $professor->sexo ==="masculino" ? 'selected' : ''}} >masculino</option>
        <option value="femenino"   {{  $professor->sexo ==="femenino" ? 'selected' : ''}}>femenino</option>
      </select>
      @error('sexo')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
    </div>
    <div class="form-group col-md-4">
      <label for="contacto">contacto</label>
      <input type="text" class="form-control @error('contacto') is-invalid @enderror" autocomplete="off" value="{{$professor->contacto}}" id="contacto" name="contacto">
      @error('contacto')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
    </div>

  </div>

  <div class="form-row">

  <div class="form-group col-md-4 ">
      <label >Data de inicio de actividade</label>
      <div class="input-group date"  >
                    <input type="date" class="form-control float-right datetimepicker-input @error('datainicio') is-invalid @enderror" value="{{$professor->datainicio}}" autocomplete="off" name="datainicio" />
                    <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                    </div>
                    @error('datainicio')
                                <div class="invalid-feedback">
                                    <h6>{{$message}}</h6>
                                </div>
                                @enderror
                    </div>



    </div>
    <div class="form-group col-md-4">
      <label for=" numeroagente"> numero de agente</label>
      <input type="text" autocomplete="off" class="form-control @error('numeroagente') is-invalid @enderror"  value="{{$professor->numeroagente}}" id="numeroagente" name=" numeroagente">
      @error('numeroagente')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror </div>
    <div class="form-group col-md-4">
      <label for="numeroINSS ">numero de INSS </label>
      <input type="text" autocomplete="off"class="form-control @error('numeroINSS') is-invalid @enderror"  value="{{$professor->numeroINSS}}" id="numeroINSS" name="numeroINSS">
      @error('numeroINSS')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
    </div>
  </div>
  <div class="form-row">
  <div class="form-group  col-md-4">
    <label for="instituicao ">instituição onde estudou  </label>
    <input type="text" autocomplete="off" class="form-control @error('instituicao') is-invalid @enderror"  value="{{$professor->instituiçãoondeestudou}}" id="instituicao " placeholder="instituicao" name="instituicao">
    @error('instituicao')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>
  <div class="form-group  col-md-4">
    <label for="nivelacademico">nivel academico</label>
    <input type="text" class="form-control @error('nivelacademico') is-invalid @enderror"  value="{{$professor->nivelacademico}}" id="nivelacademico" placeholder="nivel academico" name="nivelacademico" autocomplete="off">
    @error('nivelacademico')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>
  <div class="form-group  col-md-4">
    <label for="actividadequeexerce ">actividade que exerce 	</label>
    <input type="text" class="form-control @error('actividadequeexerce') is-invalid @enderror"  value="{{$professor->actividadequeexerce}}" id="actividadequeexerce " placeholder="actividade que exerce " name="actividadequeexerce" autocomplete="off">
    @error('actividadequeexerce')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>

  </div>

  <div class="form-row">
  <div class="form-group  col-md-4">
    <label for=" temposervico"> tempo de servico</label>
    <input type="number" class="form-control @error('temposervico') is-invalid @enderror"  value="{{$professor->temposervico}}" id="temposervico" placeholder="tempo de servico" name="temposervico" autocomplete="off">
    @error('temposervico')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>
  <div class="form-group  col-md-4">
    <label for="categoria">categoria	</label>
    <input type="text" class="form-control @error('categoria') is-invalid @enderror"  value="{{$professor->categoria}}" id="categoria" placeholder="categoria" name="categoria" autocomplete="off">
    @error('categoria')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>
  <div class="form-group  col-md-4">
    <label for="cargahoraria">carga horária</label>
    <input autocomplete="off" type="text" class="form-control @error('cargahoraria') is-invalid @enderror"  value="{{$professor->cargahorária}}" id="cargahoraria" placeholder="carga horária" name="cargahoraria">
    @error('cargahoraria')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>
  </div>
  <div class="form-row">
  <div class="form-group  col-md-4">
    <label for="escola">Escola onde  trabalha</label>
    <select id="escola" class="form-control @error('escola') is-invalid @enderror"   name="escola">
    <option selected>Seleciona a escola...</option>
        @forelse ($escolas as $escola)

        <option    value="{{ $escola->id }}" {{   $professor->escola->id ==$escola->id ? 'selected' : '' }} > {{ $escola->nomeescola }}</option>
    <li></li>
@empty
<option selected>não exite escola cadastrada no momento...</option>
@endforelse
      </select>
    @error('escola')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror

  </div>
  <div class="form-group  col-md-4">
  <label for="disciplina">disciplina que leciona</label>
    <select id="disciplina" class="form-control @error('disciplina') is-invalid @enderror"   name="disciplina">
    <option selected>Seleciona a disciplina...</option>
        @forelse ($disciplinas as $disciplina)

        <option value="{{ $disciplina->id }}"  {{$professor->professores->disciplina->id==$disciplina->id ? 'selected' : '' }} >{{ $disciplina->nome }}</option>
    <li></li>
@empty
<option selected>não exite disciplina cadastrada no momento...</option>
@endforelse
      </select>
    @error('disciplina')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>

  <div class="form-group  col-md-4">
  <label for="classe">classe que leciona</label>
    <select id="classe" class="form-control @error('classe') is-invalid @enderror"  value="{{old('classe')}}" name="classe">
    <option selected>Seleciona a classe...</option>
        @forelse ($classes as $classe)

        <option value="{{ $classe->id }}"  {{ $professor->professores->classe->id==$classe->id ? 'selected' : ''}}  >{{ $classe->nome }}</option>
    <li></li>
@empty
<option selected>não exite classe cadastrada no momento...</option>
@endforelse
      </select>
    @error('classe')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>
  </div>
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
@include ('layouts.datatable')
@section('script')
@parent
<script>
      $( function() {

      $('#datetimepicker4').datetimepicker({
                    format: 'L'
                });
  } );
  $('.select').select2();

</script>
@endsection

