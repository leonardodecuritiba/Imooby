<div id="modal_sucesso" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                </div>
                <div class="row conteudo_modal">
                    <div class="col-md-12 text-center">
                        <i class="fa fa-check-circle-o" style="font-size: 4em; color: #54ad51;"></i>
                        <center style="color:#9E9E9E;font-size:1.1em;margin-top:35px;">
                        <h3>Sucesso!</h3>
                            <span class="mensagem_modal">
                            {{session()->pull('status', '')}}
                            </span>
                        </center>
                    </div>
                </div>
            </div>
            <div class="dismiss-btn success" data-dismiss="modal">Continuar</div>
        </div>
    </div>
</div>