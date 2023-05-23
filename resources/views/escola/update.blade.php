@extends('layouts.starter')
@section('title', 'Actualizar escola')

@include ('layouts.sidebar')

@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gerenciamento de Escolas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Actualizar</a></li>
              <li class="breadcrumb-item active">Escola</li>
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
                        <a href="<?= route('escola.index') ?>" class="btn btn-sm btn-block btn-secondary"><i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
            <form action="{{route('escola.update',$escola->id) }}" method="post" class="form-horizontal">
                           @method('PUT')
                           @csrf

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label"><?=('Nome da escola')?></label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fas fa-school"></i></span>
                                </div>
                                <input type="text" name="nome" class="form-control   @error('nome') is-invalid @enderror" value="{{ $escola->nomeescola }}" placeholder="Digite o Nome da nova escola" autocomplete="off">
                                @error('nome')
                                <div class="invalid-feedback">
                                    <h6>{{$message}}</h6>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label"><?=('numero da escola')?></label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fas fa-sort-numeric-down"></i></span>
                                </div>
                                <input type="text" name="numero" class="form-control @error('numero')is-invalid @enderror"  value="{{ $escola->numeroescola }}" placeholder="Digite o numero da nova escola" autocomplete="off">
                                @error('numero')
                                <div class="invalid-feedback">
                                    <h6>{{$message}}</h6>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label"><?=('ciclo')?></label>
                        <div class="col-sm-8">

                                <select class=" form-control select2  @error('ciclo')is-invalid @enderror" multiple="multiple" data-placeholder="seleciona o ciclo que a nova escola pertençe"  name="ciclo[]"  autocomplete="off">
                                    @foreach ($ciclos as $ciclo)
                                     @forelse ($escola->ciclos as $item)
                                     <option value="{{$ciclo->id}}"  {{ $item->id==$ciclo->id ? 'selected' : ''}}>{{$ciclo->nome}}</option>
                                     @empty
                                     <option value="{{$ciclo->id}}"  {{ old('ciclo')==$ciclo->id ? 'selected' : ''}}>{{$ciclo->nome}}</option>
                                     @endforelse

                                    @endforeach
                                  </select>


                                @error('ciclo')
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
                                        <?= ('salvar')?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
    $('.select').select2();
</script>
@endsection

