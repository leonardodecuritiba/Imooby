<!-- Modal danger -->
<div id="modal_danger" class="modal fade" role="dialog">
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
                        <i class="fa fa-exclamation-triangle" style="font-size: 4em; color: #f65656;"></i>
                        <center style="color:#9E9E9E;font-size:1.1em;margin-top:35px;">
                        <h3>Ops!</h3>
                            <span class="mensagem_modal">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </span>
                        </center>
                    </div>
                </div>
            </div>
            <div class="dismiss-btn" data-dismiss="modal">Ok, entendi.</div>
        </div>
    </div>
</div>