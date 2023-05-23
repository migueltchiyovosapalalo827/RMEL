@extends('layouts.starter')
@section('title', 'Aproveitamento')

@include ('layouts.sidebar')

@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> Levatamento de Aproveitamento</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"> Aproveitamento</li>
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
                        <a href="{{ route('aproveitamento.index') }}" class="btn btn-sm btn-block btn-secondary"><i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
            <div class="col-md-12">
        <div class="card card-outline">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link  active " href="#funcionarios" data-toggle="tab">{{'Formulario de Levatamento de Aproveitamento'}}</a></li>
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane  active" id="funcionarios">
                    <form action="<?= route('aproveitamento.store') ?>" method="post" class="form-horizontal">
                           {{ csrf_field()}}
  <div class="form-row">
     <div class="form-group  col-md-4">
  <label for="classe">Escola</label>
    <select id="classe" class="form-control @error('escola_id') is-invalid @enderror"   name="escola_id">
    <option selected>Seleciona a Escola...</option>
        @forelse ($escolas  as $escola)

        <option value="{{ $escola->id }}"  {{  old("escola_id")==$escola->id ? 'selected' : ''}}>{{ $escola->nomeescola }}
        </option>
    <li></li>
@empty
<option selected>não exite classe cadastrada no momento...</option>
@endforelse
      </select>
    @error('escola_id')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>
    <div class="form-group col-md-4">
      <label for="nomeCompleto">Ano lectivo</label>
      <input type="text" class="form-control @error('anolectivo') is-invalid @enderror"  value="{{old('anolectivo')}}" id="" placeholder="anolectivo" name="anolectivo" autocomplete="off">

                               @error('anolectivo')
                                <div class="invalid-feedback">
                                    <h6>{{$message}}</h6>
                                </div>
                                @enderror
    </div>
    <div class="form-group col-md-4">
      <label for="Trimestre">Trimestre</label>
      <input type="text" class="form-control @error('Trimestre') is-invalid @enderror"   id="Trimestre" placeholder=" Trimestre" value="{{old('Trimestre')}}" name="Trimestre" autocomplete="off">
      @error('Trimestre')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
    </div>

 
  </div>
  <div class="form-row">
     <div class="form-group  col-md-4">
  <label for="classe">classe</label>
    <select id="classe" class="form-control @error('classe') is-invalid @enderror"  value="{{old('classe')}}" name="classe">
    <option selected>Seleciona a classe...</option>
        @forelse ($classes as $classe)

        <option value="{{ $classe->id }}"  {{  old("classe")==$classe->id ? 'selected' : ''}}  >{{ $classe->nome }}</option>
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
  <div class="form-group col-md-4">
      <label for="matriculados">Quantidades de Alunos Matriculados</label>
      <input type="number" class="form-control @error('matriculados') is-invalid @enderror"  value="{{old('matriculados')}}" id="matriculados" name="matriculados" autocomplete="off">
      @error('matriculados')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror

    </div>
    <div class="form-group col-md-4">
      <label for="avaliados">Quantidades de Alunos  Avaliados</label>
      <input type="number" class="form-control @error('avaliados') is-invalid @enderror"  value="{{old('avaliados')}}" id="avaliados" name="avaliados" autocomplete="off">
      @error('avaliados')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror

    </div>
    
  </div>

  <div class="form-row">
<div class="form-group col-md-4">
      <label for="aprovados">Quantidades de Alunos  Aprovados</label>
      <input type="number" class="form-control @error('aprovados') is-invalid @enderror"  value="{{old('aprovados')}}" id="aprovados" name="aprovados" autocomplete="off">
      @error('aprovados')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror

    </div>
  <div class="form-group col-md-4">
      <label for="reprovados">Quantidades de Alunos  reprovados</label>
      <input type="number" class="form-control @error('reprovados') is-invalid @enderror"  value="{{old('reprovados')}}" id="reprovados" name="reprovados" autocomplete="off">
      @error('reprovados')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror

    </div>
    <div class="form-group col-md-4">
      <label for=" desistidos"> Quantidades de Alunos  desistidos</label>
      <input type="text" autocomplete="off" class="form-control @error('desistidos') is-invalid @enderror"  value="{{old('desistidos')}}" id="desistidos" name=" desistidos">
      @error('desistidos')
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

