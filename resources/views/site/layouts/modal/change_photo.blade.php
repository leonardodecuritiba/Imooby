<!-- Modal Trocar Foto -->
<div id="modal_trocar_foto" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body" style="color: #fff; background-color: #00A7EC">
                {{Form::open(['route' => 'profile.change_photo', 'files'=>'true'])}}
                <div class="row">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="col-md-12 fonte_cadastrar" style="margin-bottom: 10px; margin-top: -10px;">
                        <h2 class="text-center" style="color: #fff;">Deseja trocar sua <b>foto</b>?</h2>
                    </div>
                    <div class="col-md-offset-3 col-md-6">
                        <img src="{{$_SELF_TEMPLATE_['Profile']->getThumbPhoto()}}"
                             style="width: 100%; margin-bottom: 5px;">
                    </div>
                    <div class="col-md-12" style="margin-bottom: 10px;">
                        <input type="file" class="form-control" name="photo" style="padding: 0px;">
                    </div>
                </div>
                <div class="row" style="margin-top: 40px;">
                    <div class="col-md-6">
                        <button href="" class="btn btn-success btn-lg btn-block"
                                style="font-weight: bold; border-radius: 0px;">Salvar
                        </button>
                    </div>
                    <div class="col-md-6">
                        <a href="" class="btn btn-danger btn-lg btn-block" data-dismiss="modal"
                           style="font-weight: bold; border-radius: 0px;">Cancelar</a>
                    </div>
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
</div>
