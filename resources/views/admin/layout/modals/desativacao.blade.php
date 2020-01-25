<div class="modal fade" id="modalDesativacao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            {{Form::open(['route'=>'index', 'method' => 'get',
            'class' => 'form-horizontal form-label-left', 'data-parsley-validate'])}}
            <div class="modal-header modal-header-danger">Confirmar Desativação</div>
            <div class="modal-body"></div>
            <div class="modal-footer">

                <button class="btn btn-danger pull-left btn-ok">Desativar</button>
                <a type="button" class="btn btn-default pull-right" data-token="{{ csrf_token() }}"
                   data-dismiss="modal">
                    Cancelar
                </a>
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>