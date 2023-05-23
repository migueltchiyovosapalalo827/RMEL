<!-- Include -->



@include('includes.nestable')
@include('includes.select2')
@include('includes.iconpicker')
@extends('layouts.starter')
@include ('layouts.sidebar')
@section('content')
<!-- Section content -->
@include('menu.update')

    <style>.fade.in{opacity: 1;}</style>

    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Lista de Menu</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Menu</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <section class="content">
    <div class="row">
        <div class="col-lg-5">
            <div class="card card-primary card-outline">
                <div id="nestable-menu" class="card-header">
                    <div class="btn-group">
                        <button class="btn btn-info btn-sm tree-tools" data-action="expand" title="Expand">
                            <i class="fas fa-chevron-down"></i>&nbsp;expandir
                        </button>
                        <button class="btn btn-info btn-sm tree-tools" data-action="collapse" title="Collapse">
                            <i class="fas fa-chevron-up"></i>&nbsp;recolher
                        </button>
                        <div class="btn-group">
                            <button class="btn btn-primary btn-sm save" data-action="save" title="Save"><i class="fa fa-save"></i><span class="hidden-xs">&nbsp;salvar</span></button>
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-warning btn-sm refresh" data-action="refresh" title="Refresh"><i class="fas fa-sync-alt"></i><span class="hidden-xs">&nbsp;actualizar</span></button>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="dd" id="menu"></div>
                </div>
            </div><!-- /.card -->
        </div>
        <!-- /.col-md-6 -->
        <div class="col-lg-7">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <div class="float-left">
                        <h5>Cadastrar Menu</h5>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('menu.store') }}" method="post" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">submenus</label>
                            <div class="col-sm-10">
                                <select class="form-control parent" name="parent_id" style="width: 100%;">
                                    <option selcted value="0">ROOT</option>
                                    @foreach ($menus as $menu)
                                        <option {{ ($menu->id == old('parent_id')) ? 'selected' : '' }} value="{{ $menu->id }}">{{ $menu->nome }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">
                                    <i class="fas fa-exclamation-triangle text-danger"></i>&nbsp;se for menu principal não selecione nenhum submenu
                                </span>
                                @error('parent_id')
                                    <div class="invalid-feedback">
                                        <h6>{{ $message }}</h6>
                                    </div>
                               @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Estado do menu</label>
                            <div class="col-sm-10">
                                <select class="form-control parent" name="active" style="width: 100%;">
                                    <option selected value="1">activo</option>
                                    <option value="0">não activo</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">icon</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fab fa-font-awesome-flag"></i></span>
                                    </div>
                                    <input type="text" name="icon" class="icon-picker form-control @error('icon') is-invalid @enderror" value="{{ old('icon') }}" placeholder="icon" autocomplete="off">
                                    @error('icon')
                                    <div class="invalid-feedback">
                                        <h6>{{ $message }}</h6>
                                    </div>
                                   @enderror
                                </div>
                                <span class="help-block">
                                    <i class="fa fa-info-circle text-info"></i>&nbsp;icon <a href="http://fontawesome.io/icons" target="_blank">http://fontawesome.io/icons</a>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Nome</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                    </div>
                                    <input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome') }}" placeholder="nome" autocomplete="off">
                                    @error('nome')
                                    <div class="invalid-feedback">
                                        <h6>{{ $message }}</h6>
                                    </div>
                                   @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label">rota</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-link"></i></span>
                                    </div>
                                    <input type="text" name="route" class="form-control @error('route') is-invalid @enderror" value="{{ old('route') }}" placeholder="rota" autocomplete="off">
                                    @error('route')
                                    <div class="invalid-feedback">
                                        <h6>{{ $message }}</h6>
                                    </div>
                                  @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Funções</label>
                            <div class="col-sm-10">
                                <select multiple="multiple" class="form-control parent" name="roles[]" data-placeholder="Funções" style="width: 100%;">
                                    @foreach ($roles as $role)
                                        <option {{ in_array($role->id, old('roles', [])) ? 'selected' : '' }} value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('roles')
                                    <h6 class="text-danger">{{ $message }}</h6>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                                <button type="submit" class="float-right btn btn-sm btn-primary">salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.col-md-6 -->
    </div>
      </section>
    @endsection
    @section('script')
    @parent
<script>
$(function () {
    $('.icon-picker').iconpicker({
        placement: 'bottomRight',
        hideOnSelect: true,
        inputSearch: true,
    });
    $('.parent').select2();

    menu();

    function menu() {
        $.get("{{route('menu.addRole')}}", function(response) {
            $('.dd').nestable({
                maxDepth: 2,
                json: response.data,
                contentCallback: (item) => {
                    return `<i class="${item.icon}"></i>&nbsp;<strong>${item.nome}</strong>&nbsp;&nbsp;&nbsp;<a href="{{ url('/') }}/${item.route}" class="dd-nodrag">${item.route}</a>
                            <span class="float-right dd-nodrag">
                                <button data-id="${item.id}" id="btn-edit" class="btn btn-primary btn-xs"><span class="fa fa-fw fa-pencil-alt"></span></button>
                                <button data-id="${item.id}" id="btn-delete" class="btn btn-danger btn-xs"><span class="fa fa-fw fa-trash"></span></button>
                            </span>`;
                }
            });
        });
    }

    $('.tree-tools').on('click', function(e) {
        var action = $(this).data('action');
        if (action === 'expand') {
            $('.dd').nestable('expandAll');
        }
        if (action === 'collapse') {
            $('.dd').nestable('collapseAll');
        }
    });
    $('.save').on('click', function (e) {
        e.preventDefault();
        var serialize = $('#menu').nestable('toArray');
        var btnSave = $(this);
        $(this).attr('disabled', true);
        $(this).html('<i class="fas fa-spinner fa-spin"></i>');

        $.ajax({
            url: `{{route('menu.sync') }}`,
            method: 'PUT',
            dataType: 'JSON',
            data: JSON.stringify(serialize)
        }).done((res) => {

            Toast.fire({
                icon: 'success',
                title: res.message
            });
            btnSave.attr('disabled', false);
            btnSave.html('<i class="fa fa-save"></i> ' + "salvar");
            $('.dd').nestable('destroy');
            menu();
        }).fail((error) => {

            Toast.fire({
                icon: 'error',
                title: error.responseJSON.message,
            });
            btnSave.attr('disabled', false);
            btnSave.html('<i class="fa fa-save"></i> ' + "salvar");
        })
    });

    $('.refresh').on('click', function (e) {
        location.reload(true);
    });

    $(document).on('click', '#btn-edit', function(e) {
        e.preventDefault();
        $('.is-invalid').removeClass('is-invalid');

        $.ajax({
            url: `{{ url('/menu') }}/${$(this).attr('data-id')}/edit`,
            method: 'GET',
            dataType: 'JSON',

        }).done((response) => {

            $('#active').select2();
            $('#parent_id').select2({
                data: response.menus
            });
            $('#groups_menu').select2({
                data: response.roles
            });
            var editForm = $('#form-edit');


           // var group = group_id.split('|');
           var parent_id = response.menu.parent_id == null ? 0 : response.menu.parent_id;
            editForm.find('select[name="active"]').val(response.menu.active).change();
            editForm.find('select[name="parent_id"]').val(parent_id).change();
            editForm.find('select[name="roles[]"]').val(response.role).change();
            editForm.find('input[name="icon"]').val(response.menu.icon);
            editForm.find('input[name="nome"]').val(response.menu.nome);
            editForm.find('input[name="route"]').val(response.menu.route);
            $("#menu_id").val(response.menu.id);
            $('#modal-update').modal('show');

        }).fail((jqXHR, textStatus, errorThrown) => {
            Toast.fire({
                icon: 'error',
                title: jqXHR.responseJSON.messages.error,
            });
        })
    });

    $(document).on('click', '#btn-update', function(e) {
        e.preventDefault();
        $('.invalid-feedback').remove();
        $('#erros').html('');
        var editForm = $('#form-edit');

        $.ajax({
            url: `{{url('/menu')}}/${ $('#menu_id').val() }`,
            method: 'PUT',
            data: editForm.serialize()

        }).done((data) => {
            console.log(data);
            Toast.fire({
                icon: 'success',
                title: data.message
            });

            $('.dd').nestable('destroy');
            menu();
            $("#form-edit").trigger("reset");
            $("#modal-update").modal('hide');

        }).fail(( error) => {
            /*$.each(xhr.responseJSON.messages, (elem, messages) => {
                editForm.find('input[name="' + elem + '"]').addClass('is-invalid').after('<p class="invalid-feedback">' + messages + '</p>');
            });*/
            $('#erros').append('<p class="text-danger">'+error.responseJSON.errors+'</p>');
        })
    });

    $(document).on('click', '#btn-delete', function(e) {
        Swal.fire({
            title: 'pretende mesmo apagar este menu?',
            text: "não será possível reverter isso!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'sim exclua'
        })
        .then((result) => {
            if (result.value) {
                $.ajax({
                    url: `{{ url('/menu')}}/${$(this).attr('data-id')}`,
                    method: 'DELETE',
                }).done((data, textStatus, jqXHR) => {
                    Toast.fire({
                        icon: 'success',
                        title: jqXHR.statusText,
                    });
                    $('.dd').nestable('destroy');
                    menu();
                }).fail((jqXHR, textStatus, errorThrown) => {
                    Toast.fire({
                        icon: 'error',
                        title: jqXHR.responseJSON.messages.error,
                    });
                })
            }
        })
    })

    $('#modal-edit').on('hidden.bs.modal', function() {
        $(this).find('#form-edit').reset();
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').removeClass('invalid-feedback');
    });
})
</script>

@endsection
