@extends('layouts.starter')
@section('title', 'novo  professor')

@include ('layouts.sidebar')

@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cadastrar funcionario</h1>
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
                    <form action="<?= route('docente.store') ?>" method="post" class="form-horizontal">
                           {{ csrf_field()}}
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="nomeCompleto">Nome completo</label>
      <input type="text" class="form-control @error('nome') is-invalid @enderror"  value="{{old('nome')}}" id="nomeCompleto" placeholder="Nome completo" name="nome" autocomplete="off">

                               @error('nome')
                                <div class="invalid-feedback">
                                    <h6>{{$message}}</h6>
                                </div>
                                @enderror
    </div>
    <div class="form-group col-md-6">
      <label for="bi">Numero do Bi</label>
      <input type="text" class="form-control @error('bi') is-invalid @enderror"   id="bi" placeholder="Numero do Bi" value="{{old('bi')}}" name="bi" autocomplete="off">
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
      <input type="number" class="form-control @error('idade') is-invalid @enderror"  value="{{old('idade')}}" id="idade" name="idade" autocomplete="off">
      @error('idade')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror

    </div>
    <div class="form-group col-md-4">
      <label for="sexo">Sexo</label>
      <select id="sexo" class="form-control select2 @error('sexo') is-invalid @enderror" data-placeholder="seleciona  o sexo"   name="sexo">
        <option value="">Seleciona...</option>
        <option value="masculino"  {{  old("sexo")==="masculino" ? 'selected' : ''}} >masculino</option>
        <option value="femenino"   {{  old("sexo")==="femenino" ? 'selected' : ''}}>femenino</option>
      </select>
      @error('sexo')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
    </div>
    <div class="form-group col-md-4">
      <label for="contacto">contacto</label>
      <input type="text" class="form-control @error('contacto') is-invalid @enderror" autocomplete="off" value="{{old('contacto')}}" id="contacto" name="contacto">
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
      <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                    <input type="text" class="form-control float-right datetimepicker-input @error('datainicio') is-invalid @enderror" value="<?= old('datainicio') ?>" autocomplete="off" name="datainicio" data-target="#datetimepicker4"/>
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
      <input type="text" autocomplete="off" class="form-control @error('numeroagente') is-invalid @enderror"  value="{{old('numeroagente')}}" id="numeroagente" name=" numeroagente">
      @error('numeroagente')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror </div>
    <div class="form-group col-md-4">
      <label for="numeroINSS ">numero de INSS </label>
      <input type="text" autocomplete="off"class="form-control @error('numeroINSS') is-invalid @enderror"  value="{{old('numeroINSS')}}" id="numeroINSS" name="numeroINSS">
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
    <input type="text" autocomplete="off" class="form-control @error('instituicao') is-invalid @enderror"  value="{{old('instituicao ')}}" id="instituicao " placeholder="instituicao" name="instituicao">
    @error('instituicao')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>
  <div class="form-group  col-md-4">
    <label for="nivelacademico">nivel academico</label>
    <input type="text" class="form-control @error('nivelacademico') is-invalid @enderror"  value="{{old('nivelacademico')}}" id="nivelacademico" placeholder="nivel academico" name="nivelacademico" autocomplete="off">
    @error('nivelacademico')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>
  <div class="form-group  col-md-4">
    <label for="escola">Escola onde trabalha</label>
    <select id="escola" class="form-control select2 @error('escola') is-invalid @enderror"  data-placeholder="seleciona  a  escola trabalha"  name="escola">
        <option value="">Seleciona...</option>
 @foreach ($escolas as $escola)
  <option    value="{{ $escola->id }}" {{   old("escola")==$escola->id ? 'selected' : '' }} > {{ $escola->nomeescola }}</option>
  @endforeach

      </select>
    @error('escola')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror

  </div>

  </div>

  <div class="form-row">
  <div class="form-group  col-md-4">
    <label for=" temposervico"> tempo de servico</label>
    <input type="number" class="form-control @error('temposervico') is-invalid @enderror"  value="{{old('temposervico')}}" id="temposervico" placeholder="tempo de servico" name="temposervico" autocomplete="off">
    @error('temposervico')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>
  <div class="form-group  col-md-4">
    <label for="categoria">categoria	</label>
    <input type="text" class="form-control @error('categoria') is-invalid @enderror"  value="{{old('categoria')}}" id="categoria" placeholder="categoria" name="categoria" autocomplete="off">
    @error('categoria')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>
  <div class="form-group  col-md-4">
    <label for="cargahoraria">carga horária</label>
    <input autocomplete="off" type="text" class="form-control @error('cargahoraria') is-invalid @enderror"  value="{{old('cargahorária')}}" id="cargahoraria" placeholder="carga horária" name="cargahoraria">
    @error('cargahoraria')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>
  </div>
  <div class="form-row">
  <div class="form-group  col-md-4">
    <label for="actividadequeexerce">actividade que exerce 	</label>
    <select id="actividadequeexerce" class="form-control select2 @error('actividadequeexerce') is-invalid @enderror"     name="actividadequeexerce" autocomplete="off">
  <option value="">Seleciona...</option>
  <option    value="Director Geral" {{  old("actividadequeexerce")=="Director Geral" ? 'selected' : '' }} > Director Geral </option>
  <option    value="Director pedagogica" {{  old("actividadequeexerce")=="Director pedagogica" ? 'selected' : '' }} > Director pedagogica</option>
  <option    value="Director Administrativo" {{  old("actividadequeexerce")=="Director Administrativo" ? 'selected' : '' }} > Director Administrativo</option>
  <option    value="Professor" {{ old("actividadequeexerce")== "Professor" ? 'selected' : '' }} > Professor </option>
  <option    value="Secretario" {{ old("actividadequeexerce")=="Secretario" ? 'selected' : '' }} > Secretario</option>
  <option    value="Auxiliar de Limpesa" {{ old("actividadequeexerce")=="Auxiliar de Limpesa"? 'selected' : '' }} > Auxiliar de Limpesa</option>

      </select>

    @error('actividadequeexerce')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror


  </div>

  <div class="form-group  col-md-4" id="disciplinaleciona">
  <label for="disciplina">disciplina que leciona</label>
    <select id="disciplina" class="form-control select2 @error('disciplina') is-invalid @enderror"  data-placeholder="seleciona a disciplina que leciona"   name="disciplina">
     @foreach ($disciplinas as $disciplina)
     <option value="">Seleciona...</option>
     <option value="{{ $disciplina->id }}"  {{   old("disciplina")==$disciplina->id ? 'selected' : '' }} >{{ $disciplina->nome }}</option>
     @endforeach

      </select>
    @error('disciplina')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>

  <div class="form-group  col-md-4" id="classeleciona">
  <label for="classe">classe que leciona</label>
    <select id="classe" class="form-control select2 @error('classe') is-invalid @enderror"  data-placeholder="seleciona a classe que leciona"  name="classe">
        <option value="">Seleciona...</option>
        @foreach ($classes as $classe)
          <option value="{{ $classe->id }}"  {{  old("classe")==$classe->id ? 'selected' : ''}}  >{{ $classe->nome }}</option>
          @endforeach

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

@section('script')
@parent
<script>
      $( function() {
        $('#disciplinaleciona').hide();
        $('#classeleciona').hide();
      $('#datetimepicker4').datetimepicker({
                    format: 'L'
                });
      $('#actividadequeexerce').change(function () {
        var cargo = $(this).val();
        if(cargo === "Professor")
        {
         $('#disciplinaleciona').show();
         $('#classeleciona').show();
        } else {
          $('#disciplinaleciona').hide();
          $('#classeleciona').hide();
        }
      })

  } );


</script>
@endsection

