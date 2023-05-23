@extends('layouts.starter')
@section('title', 'class')

@include ('layouts.sidebar')

@section('content')
 <!-- Content Header (Page header) -->
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Editar classe</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">classes</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <div class="card-header">
                <div class="float-left">
                    <div class="btn-group">
                        <a href="{{ route('documento.index') }}" class="btn btn-sm btn-block btn-secondary"><i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('documento.update', $documento['id']) }}" method="post" class="form-horizontal"
                  enctype="multipart/form-data" 
                >
                @method('PUT')
               @csrf

                   <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">tipo de documento </label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-edit"></i></span>
                                </div>
                                <input type="text" name="tipo" class="form-control @error('tipo') is-invalid @enderror" value="<?= $documento['tipo'] ?>" placeholder="tipo de decumento" autocomplete="off">
                                @error('tipo')
                                <div class="invalid-feedback">
                                    <h6>{{$message}}</h6>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">nome do  documento </label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-edit"></i></span>
                                </div>
                                <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror" value="<?= $documento['nome'] ?>" placeholder="nome" autocomplete="off">
                                @error('nome')
                                <div class="invalid-feedback">
                                    <h6>{{$message}}</h6>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label"><?=('escola')?></label>
                        <div class="col-sm-8">
                            <div class="input-group">

                                <select class=" form-control select2  @error('escola')is-invalid @enderror"  data-placeholder="seleciona o escola que o documento pertençe"  name="escola"  autocomplete="off">
                                       <option value=""></option>
                                    @foreach ($escolas as $escola)
                                    <option value="{{$escola->id}}"  {{ $documento->escolas->id == $escola->id ? 'selected' : ''}}>{{$escola->nomeescola}}</option>
                                    @endforeach
                                  </select>



                            </div>
                            @error('escola')
                            <div class="invalid-feedback">
                                <h6>{{$message}}</h6>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label"><?=('ciclo')?></label>
                        <div class="col-sm-8">
                            <div class="input-group">

                                <select class=" form-control select2  @error('ciclo')is-invalid @enderror"  data-placeholder="selecione o ciclo que o documento pertençe"  name="ciclo"  autocomplete="off">
                                    <option value=""></option>
                                    @foreach ($ciclos as $ciclo)
                                    <option value="{{$ciclo->id}}"  {{ $documento->ciclos->id == $ciclo->id ? 'selected' : ''}}>{{$ciclo->nome}}</option>
                                    @endforeach
                                  </select>

                            </div>
                            @error('ciclo')
                                <div class="invalid-feedback">
                                    <h6>{{$message}}</h6>
                                </div>
                                @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label"><?=('Ano Lectivo')?></label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fas fa-sort-numeric-down"></i></span>
                                </div>
                                <input type="text" name="ano" class="form-control @error('ano')is-invalid @enderror"  value="{{ $documento->ano }}" placeholder="Digite o ano da nova escola" autocomplete="off">
                                @error('ano')
                                <div class="invalid-feedback">
                                    <h6>{{$message}}</h6>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="exampleInputFile">Documetos</label>
                     <div class="col-sm-8">
                    <div class="input-group">
                      <div class="custom-file">
                         <input type="file" class="custom-file-input @error('documentos') is-invalid @enderror" id="exampleInputFile" name="documentos">
                        <label class="custom-file-label" for="exampleInputFile">Escolhe o Documento</label>
                       
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>
                      @error('documentos')
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
                                        salvar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                         @if($errors->any())
                       @dd($errors)
                       @endif
                </form>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
@section('script')
@parent
<script>
    $('.select').select2();
</script>
@endsection

